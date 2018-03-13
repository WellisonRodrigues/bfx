<?php

/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 28/02/2018
 * Time: 21:06
 */
class Myprofile extends CI_Controller
{
    private $url;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user")) {
            redirect('sair');
        }

        $this->url = $this->geturl->get_url();

    }


    public function index()
    {

        $type = $this->session->userdata("user")['client_type'];
        $id = $this->session->userdata("user")['id'];
        $data['dados'] = $this->get_myprofile($type, $id);
        $data['view'] = 'forms/myprofile_form';
        $this->load->view('template_admin/core', $data);

    }

    public function update_user()
    {
        if ($this->input->post('submit')) {
            if ($this->session->userdata('user')['client_type'] == 'managers') {
                if ($this->input->post('pass') != '') {
                    $array_dados = array(
                        'name' => $this->input->post('name'),
                        'full_name' => $this->input->post('full_name'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'cpf' => $this->input->post('cpf'),
                        'password' => $this->input->post('pass'),
                        'password_confirmation' => $this->input->post('pass_comfirm'),

                    );
                    $retorno = $this->update_profile_ws($array_dados);

                } else {

                    $array_dados = array(
                        'name' => $this->input->post('name'),
                        'full_name' => $this->input->post('full_name'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                        'cpf' => $this->input->post('cpf'),
                    );
                    $retorno = $this->update_profile_ws($array_dados);

                }
            } else {
                if ($this->input->post('pass') != '') {
                    $array_dados = array(
                        'name' => $this->input->post('name'),
                        'full_name' => $this->input->post('full_name'),
                        'email' => $this->input->post('email'),
                        'razao_social' => $this->input->post('razao_social'),
                        'cnpj' => $this->input->post('cnpj'),
                        'password' => $this->input->post('pass'),
                        'password_confirmation' => $this->input->post('pass_comfirm'),

                    );
//                    print_r($this->input->post());
                    $retorno = $this->update_profile_ws($array_dados);
//                    print_r($retorno);
//                    die;
                } else {

                    $array_dados = array(
                        'name' => $this->input->post('name'),
                        'full_name' => $this->input->post('full_name'),
                        'email' => $this->input->post('email'),
                        'razao_social' => $this->input->post('razao_social'),
                        'cnpj' => $this->input->post('cnpj'),
                    );
                    $retorno = $this->update_profile_ws($array_dados);

                }
            }
//                print_r($retorno);
//                die;
            if ($retorno['response']['password']) {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => $retorno['response']['password'][0]
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
//                die;
                redirect('Myprofile/index');

            } else {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário atualizado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Myprofile/index');

            }
        }
    }

    private function update_profile_ws($params)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client_user = $this->session->userdata('user')['clientHeader'];
        $array_fields = json_encode($params);
//        print_r($array_fields);
//        print_r($id_agenda);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/profile",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => "$array_fields",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client_user",
                "content-type: application/json",
//                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 7664523d-ec35-41ac-078e-172015643508",
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
//        print_r($response);
//        die;
        return $resp;

    }

    private
    function get_myprofile()
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/my-profile",
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
//        print_r($resp);
        return $resp;

    }

    public
    function arrayCastRecursive($array)
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