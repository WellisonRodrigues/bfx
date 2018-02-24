<?php

/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:33
 */
class Employees extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user")) {
            redirect('sair');
        }
        $this->load->library('table');
    }

    public function index()
    {
        $return = $this->get_employees_ws();
        $data['employees'] = $return['response'];
        $data['view'] = 'forms/employees_list';
        $this->load->view('template_admin/core', $data);
//        print_r($this->get_clients_ws());
    }

    public function get_employees_ws()
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://bfx-api.herokuapp.com/admin/painel/employees",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\ngerente\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\ngerente@spacex.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n123123123\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password_confirmation\"\r\n\r\n123123123\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 6bc2f2bb-e39b-479c-2eba-bc417e77d154",
                "uid: $uid"
            ),
        ));

        $headers = [];
        curl_setopt($curl, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                    return $len;

                $name = strtolower(trim($header[0]));
                if (!array_key_exists($name, $headers))
                    $headers[$name] = [trim($header[1])];
                else
                    $headers[$name][] = trim($header[1]);

                return $len;
            }
        );

        $response = curl_exec($curl);
        $resposta = json_decode($response);
        $err = curl_error($curl);
        curl_close($curl);
        $array = $this->arrayCastRecursive($resposta);
        $resp['response'] = $array;
        $resp['headers'] = $headers;
        $resp['err'] = $err;
        return $resp;
    }

    public function arrayCastRecursive($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->arrayCastRecursive($value);
                }
                if ($value instanceof stdClass) {
                    $array[$key] = $this->arrayCastRecursive((array)$value);
                }
            }
        }
        if ($array instanceof stdClass) {
            return $this->arrayCastRecursive((array)$array);
        }
        return $array;
    }
}