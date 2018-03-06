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
        $data['alert'] =
            [
                'type' => 'erro',
                'message' => 'Modulo em desenvolvimento.'
            ];
        $this->session->set_flashdata('alert', $data['alert']);
        redirect('Agendas/index');
        if ($this->input->post('submit')) {
//            print_r($this->input->post());
            $name = $this->input->post('name');
            $pass = $this->input->post('pass');
            $full_name = $this->input->post('full_name');
            $pass_comfirm = $this->input->post('pass_comfirm');
            $email = $this->input->post('email');

            if ($this->session->userdata('user')['client_type'] != 'admin') {
                $client = $this->input->post('client');
            } else {
                $client = null;
            }

            $phone = $this->input->post('phone');
            $cpf = $this->input->post('cpf');
//
//            print_r($this->post_manager_ws($name, $pass, $pass_comfirm, $email, $client, $cpf, $phone));
//            die;
            $var = $this->post_agenda_ws($name, $full_name, $pass, $pass_comfirm, $email, $client, $cpf, $phone)['response'];

            if ($var['status'] == 'success') {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário cadastrado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Managers/index');
            } else {
                foreach ($var['errors']['full_messages'] as $full_message) {
                    $data['alert'] =
                        [
                            'type' => 'erro',
                            'message' => $full_message
                        ];
                    $this->session->set_flashdata('alert', $data['alert']);
                }
                redirect('Managers/new_manager');

            }
        }
        $data['agendas'] = $this->get_agenda_ws();
        $data['view'] = 'forms/agenda_form';
        $this->load->view('template_admin/core', $data);
    }

    public function edit_rota($id_manager)
    {
        $data['alert'] =
            [
                'type' => 'erro',
                'message' => 'Modulo em desenvolvimentos.'
            ];
        $this->session->set_flashdata('alert', $data['alert']);
        redirect('Agendas/index');
        $data['manager'] = $this->get_agenda_id_ws($id_manager);
        if ($this->input->post('submit') and $id_manager != null) {
            $name = $this->input->post('name');
            $full_name = $this->input->post('full_name');
            $pass = $this->input->post('pass');
            $pass_comfirm = $this->input->post('pass_comfirm');
            $email = $this->input->post('email');
            $client = $this->input->post('client');
            $cpf = $this->input->post('cpf');
            $phone = $this->input->post('phone');
//
            if ($this->put_agenda_ws($id_manager, $name, $full_name, $pass, $pass_comfirm, $email, $client, $cpf, $phone)) {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário atualizado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Managers/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => 'Erro ao atualizado o usuario.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect("Managers/edit_manager/$id_manager");

            }
        }

        $data['view'] = 'forms/edit_manager_form';
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
                        'message' => 'Erro ao deletar a agenda.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Agendas/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Agenda deletada com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Agendas/index');
            }
        }
    }

    private function put_agenda_ws($id_manager, $name, $full_name, $pass, $pass_comfirm, $email, $client, $cpf, $phone)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client_user = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/painel/managers/$id_manager",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\n$name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n$email\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n$pass\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password_confirmation\"\r\n\r\n$pass_comfirm\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"full_name\"\r\n\r\n$full_name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"phone\"\r\n\r\n$phone\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"cpf\"\r\n\r\n$cpf\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"client_id\"\r\n\r\n$client\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client_user",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
                "postman-token: 7ca904b1-90a9-5011-a525-06e2daedcfd0",
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

    private function post_agenda_ws($name, $full_name, $pass, $pass_comfirm, $email, $client, $cpf, $phone)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client_user = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\n$name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n$email\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n$pass\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password_confirmation\"\r\n\r\n$pass_comfirm\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"full_name\"\r\n\r\n$full_name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"phone\"\r\n\r\n$phone\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"cpf\"\r\n\r\n$cpf\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"client_id\"\r\n\r\n$client\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client_user",
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
            CURLOPT_URL => "$this->url/admin/managers/agendas/$id",
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

    private function get_agenda_id_ws($id)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/managers/agendas/$id",
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