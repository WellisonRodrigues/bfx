<?php

/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:33
 */
class Clients extends CI_Controller
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
        $return = $this->get_clients_ws();
        $data['clients'] = $return['response'];
        $data['view'] = 'forms/clients_list';
        $this->load->view('template_admin/core', $data);
//        print_r($this->get_clients_ws());
    }

    public function new_client()
    {
        if ($this->input->post('submit')) {
            $name = $this->input->post('name');
            $full_name = $this->input->post('full_name');
            $pass = $this->input->post('pass');
            $pass_comfirm = $this->input->post('pass_comfirm');
            $email = $this->input->post('email');
            $razao = $this->input->post('razao');
            $cnpj = $this->input->post('cnpj');


            if ($this->post_clients_ws($name, $full_name, $pass, $pass_comfirm, $email, $razao, $cnpj)['response']['status'] == 'success') {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário cadastrado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Clients/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => 'Erro ao cadastrar o usuario.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Clients/index');

            }
        }
        $data['view'] = 'forms/client_form';
        $this->load->view('template_admin/core', $data);
    }

    public function edit_client($id_client)
    {
        $data['client'] = $this->get_clients_id_ws($id_client);
        if ($this->input->post('submit') and $id_client != null) {

            if ($this->input->post('pass') != '') {
                $array_dados = array(
                    'name' => $this->input->post('name'),
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'razao' => $this->input->post('razao'),
                    'cnpj' => $this->input->post('cnpj'),
                    'password' => $this->input->post('pass'),
//                    'password_confirm' => $this->input->post('pass_comfirm'),

                );
                $retorno = $this->put_clients_ws($id_client, $array_dados);

            } else {

                $array_dados = array(
                    'name' => $this->input->post('name'),
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'razao' => $this->input->post('razao'),
                    'cnpj' => $this->input->post('cnpj'),
                );
                $retorno = $this->put_clients_ws($id_client, $array_dados);

            }
            if ($retorno['response']['password']) {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => $retorno['response']['password'][0]
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
//                die;
                redirect('Clients/edit_client/' . $id_client);

            } else {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário atualizado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Clients/index');

            }
        }
        $data['view'] = 'forms/edit_client_form';
        $this->load->view('template_admin/core', $data);
    }

    public
    function delete_client($user_id)
    {
        if ($user_id != null or $user_id != '') {
            $response = $this->delete_client_ws($user_id);
            if ($response['errors']) {
                $data['alert'] =
                    [
                        'type' => 'erro',
                        'message' => 'Erro ao deletar o usuario.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Clients/index');
            } else {
                $data['alert'] =
                    [
                        'type' => 'sucesso',
                        'message' => 'Usuário deletado com sucesso.'
                    ];
                $this->session->set_flashdata('alert', $data['alert']);
                redirect('Clients/index');
            }
        }
    }

    private
    function post_clients_ws($name, $full_name, $pass, $pass_comfirm, $email, $razao, $cnpj)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/clients",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"full_name\"\r\n\r\n$full_name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"email\"\r\n\r\n$email\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n$pass\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password_confirmation\"\r\n\r\n$pass_comfirm\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"cnpj\"\r\n\r\n$cnpj\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"razao_social\"\r\n\r\n$razao\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"name\"\r\n\r\n$name\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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

    private
    function put_clients_ws($id_client, $params)
    {
        $array_dados = json_encode($params);

        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/painel/clients/$id_client",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "$array_dados",
            CURLOPT_HTTPHEADER => array(
                "access-token: $aut_code",
                "cache-control: no-cache",
                "client: $client",
                "content-type: application/json",
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
//        print_r($resp);
//        die;
        return $resp;
    }

    private
    function get_clients_ws()
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/painel/clients",
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

    private
    function get_clients_id_ws($id)
    {
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/painel/clients/$id",
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

    private
    function delete_client_ws($id)
    {
        $curl = curl_init();
        $aut_code = $this->session->userdata('user')['access-token'];
        $uid = $this->session->userdata('user')['uid'];
        $client = $this->session->userdata('user')['clientHeader'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->url/admin/painel/clients/$id",
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