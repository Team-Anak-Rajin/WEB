<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    protected $httpClient;
    protected $apiUrl;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->httpClient = \Config\Services::curlrequest();
        $this->apiUrl = 'http://localhost:3000/api/';
    }

    public function index()
    {
        $data = [
            'title' => 'Auth Form'
        ];
        return view('v_auth/auth', $data);
    }

    public function registerUser()
    {
        try {
            $data = [
                'username' => $this->request->getPost('usernameRegist'),
                'password' => $this->request->getPost('passwordRegist'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'hp' => $this->request->getPost('hp'),
            ];

            $url = $this->apiUrl . 'users/register';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $this->session->setFlashdata('success', $responseData['message']);
                return redirect()->to('auth');
            } else {
                $this->session->setFlashdata('error', $responseData['message'] ?? 'An error occurred. Please try again.');
                return redirect()->to('auth');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to('auth');
        }
    }

    public function loginUser()
    {
        try {
            $data = [
                'username' => $this->request->getPost('usernameLogin'),
                'password' => $this->request->getPost('passwordLogin'),
            ];

            $url = $this->apiUrl . 'users/login';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $this->session->set('user_token', $responseData['token']);
                return redirect()->to('');
            } else {
                $this->session->setFlashdata('error', $responseData['message'] ?? 'An error occurred. Please try again.');
                return redirect()->to('auth');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to('auth');
        }
    }

    public function logoutUser()
    {
        $this->session->destroy();

        return redirect()->to('auth');
    }
}
