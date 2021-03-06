<?php

/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:33
 */
class Rotas extends CI_Controller
{
    private $url;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("user")) {
            redirect('sair');
        }
        $this->url = $this->geturl->get_url();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $return = $this->get_rota_ws();
        $data['rotas'] = $return['response'];
//print_r($return);
        $data['view'] = 'forms/rotas_list';
        $this->load->view('template_admin/core', $data);
//        print_r($this->get_clients_ws());
    }

    public function new_rota()
    {
//        $data['alert'] =
//            [
//                'type' => 'erro',
//                'message' => 'Modulo em desenvolvimento.'
//            ];
//        $this->session->set_flashdata('alert', $data['alert']);
//        redirect('Agendas/index');
        if ($this->input->post('submit')) {

            $params = array(
                'company_name' => $this->input->post('company_name'),
                'address' => $this->input->post('address'),
                'number' => $this->input->post('number'),
                'complement' => $this->input->post('complement'),
                'neighborhood' => $this->input->post('neighborhood'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
//                'hour' => $this->input->post('hour'),
//                'day' => $this->input->post('day')
            );

            $var = $this->post_rota_ws($params)['response'];

            if ($var) {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Local cadastrado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Rotas/index');
            } else {
                foreach ($var['errors']['full_messages'] as $full_message) {
                    $data['alert'] =
                        [
                            'type' => 'erro',
                            'message' => $full_message
                        ];
                    $this->session->set_flashdata('alert', $data['alert']);
                }
                redirect('Rotas/new_rota');

            }
        }
        $data['agendas'] = $this->get_rota_ws();
        $data['view'] = 'forms/rotas_form';
        $this->load->view('template_admin/core', $data);
    }

    public function edit_rota($id_rota)
    {

        $data['rotas'] = $this->get_rota_id_ws($id_rota);
        if ($this->input->post('submit') and $id_rota != null) {
            $params = array(
                'company_name' => $this->input->post('company_name'),
                'address' => $this->input->post('address'),
                'number' => $this->input->post('number'),
                'complement' => $this->input->post('complement'),
                'neighborhood' => $this->input->post('neighborhood'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
//                'hour' => $this->input->post('hour'),
//                'day' => $this->input->post('day')
            );

//
            if ($this->put_rota_ws($id_rota, $params)) {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Local atualizado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Rotas/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => 'Erro ao atualizado o usuario.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect("Rotas/edit_rotas/$id_rota");

            }
        }

        $data['view'] = 'forms/edit_rotas_form';
        $this->load->view('template_admin/core', $data);
    }

    public function delete_rota($id_manager)
    {
        if ($id_manager != null or $id_manager != '') {
            $response = $this->delete_agenda_ws($id_manager);
            if ($response['errors']) {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => 'Erro ao deletar o local.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Rotas/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Local deletado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Rotas/index');
            }
        }
    }

    private function put_rota_ws($id_rota, $params)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client_user = $this->session->userdata('user')['clientHeader'];
        $array_fields = json_encode($params);
//        print_r($array_fields);
//        print_r($id_agenda);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/locals/$id_rota",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
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

    private function post_rota_ws($params)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client_user = $this->session->userdata('user')['clientHeader'];
        $array_fields = json_encode($params);
//        print_r($array_fields);
//        print_r($id_agenda);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/locals",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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
//        print_r($resp);
//        die;
        return $resp;
    }


    private function delete_agenda_ws($id)
    {
        $curl = curl_init();
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/locals/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client",
                "postman-token: 6efb212f-9d29-0338-fe07-9d838840daff",
                "uid: $uid"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $return = $this->arrayCastRecursive(json_decode($response));
            return $return;
        }
    }

    private function get_rota_id_ws($id)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/locals/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"full_name\"\r\n\r\nJonh Doe\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\njonhdoe@empresaspacex.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 30011478-d090-f8e8-b9a8-b90aba104de3",
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

    private function get_rota_ws()
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/locals?option=all",
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
//                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
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