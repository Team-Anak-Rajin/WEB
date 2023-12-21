<?php

namespace App\Controllers;

class MainController extends BaseController
{

    protected $httpClient;
    protected $apiUrl;
    protected $fileUrl;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->httpClient = \Config\Services::curlrequest();
        $this->apiUrl = 'http://localhost:3000/api/';
        $this->fileUrl = 'http://localhost:3000/public/';
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'navbar' => $this->getNavbar()
        ];

        return view('v_home/home', $data);
    }

    public function getNavbar()
    {
        $userData = $this->getUser();
        return view('layout/navbar', ['user' => $userData]);
    }


    private function getUser()
    {
        try {
            $userToken = $this->session->get('user_token');

            if (empty($userToken)) {
                session()->setFlashdata('error', 'User not authenticated');
            }

            $url = $this->apiUrl . 'users/detail';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $userToken,
                'Content-Type: application/json',
            ]);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                return $responseData['user'];
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserDetails()
    {
        try {
            $userToken = $this->session->get('user_token');

            if (empty($userToken)) {
                session()->setFlashdata('error', 'User not authenticated');
            }

            $url = $this->apiUrl . 'users/detail';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $userToken,
                'Content-Type: application/json',
            ]);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $data = [
                    'title' => 'Profile User',
                    'navbar' => $this->getNavbar(),
                    'user' => $responseData['user'],
                    'status' => 'success'
                ];
                return view('v_profile/profile', $data);
            } else {
                $data = [
                    'status' => 'error',
                    'title' => 'Profile User',
                    'navbar' => $this->getNavbar(),
                ];
                return view('v_profile/profile', $data);
            }
        } catch (\Exception $e) {
            $data = [
                'status' => 'error',
                'title' => 'Profile User',
                'navbar' => $this->getNavbar(),
            ];
            return view('v_profile/profile', $data);
        }
    }

    public function updateUser()
    {
        try {
            $userToken = $this->session->get('user_token');

            if (empty($userToken)) {
                session()->setFlashdata('error', 'User not authenticated');
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'hp' => $this->request->getPost('hp'),
                'password' => $this->request->getPost('password'),
            ];

            $url = $this->apiUrl . 'users/update';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: ' . $userToken,
            ]);

            $responseBody = curl_exec($ch);

            curl_close($ch);
            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $this->session->setFlashdata('success', $responseData['message']);
                return redirect()->to('app/profile');
            } else {
                $this->session->setFlashdata('error', $responseData['message'] ?? 'An error occurred. Please try again');
                return redirect()->to('app/profile');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'An error occurred. Please try again');
            return redirect()->to('app/profile');
        }
    }

    public function store()
    {
        $data = [
            'title' => 'Search Store',
            'navbar' => $this->getNavbar(),
        ];


        return view('v_store/store', $data);
    }

    public function getStores()
    {
        try {
            $isOpened = $this->request->getPost('isOpened');
            $isOpenedBoolean = ($isOpened == '1');

            $data = [
                'userLatitude' => $this->request->getPost('userLatitude'),
                'userLongitude' => $this->request->getPost('userLongitude'),
                'keyword' => $this->request->getPost('searchInput'),
                'radius' => $this->request->getPost('radius'),
                'minRating' => $this->request->getPost('rating'),
                'isOpened' => $isOpenedBoolean,
                'minPrice' => $this->request->getPost('minPrice'),
                'maxPrice' => $this->request->getPost('maxPrice'),
                'category' => $this->request->getPost('category')
            ];

            $url = $this->apiUrl . 'places/place';

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
                $this->session->set('nextPageToken', $responseData['nextPageToken']);
                $data = [
                    'resData' => $responseData['data']
                ];
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 'error',
                    'message' => $responseData['message'],
                ];
                echo json_encode($data);
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return null;
        }
    }

    public function getNextStores($userLatitude, $userLongitude)
    {
        try {

            $data = [
                'nextPageToken' => $this->session->get('nextPageToken'),
                'userLatitude' => $userLatitude,
                'userLongitude' => $userLongitude,
            ];

            $url = $this->apiUrl . 'places/getNextPlace';

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
                $data = [
                    'resData' => $responseData['data']
                ];
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 'error',
                    'message' => $responseData['message'],
                ];
                echo json_encode($data);
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    public function storeDetail($idPlace)
    {
        try {

            $data = [
                'idPlace' => $idPlace,
            ];

            $url = $this->apiUrl . 'places/getDetailPlace';

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
                $data = [
                    'title' => 'Detail Place',
                    'navbar' => $this->getNavbar(),
                    'status' => 'success',
                    'resData' => $responseData['data']
                ];
                return view("v_store/store-detail", $data);
            } else {
                $data = [
                    'title' => 'Detail Place',
                    'navbar' => $this->getNavbar(),
                    'status' => 'error',
                    'message' => $responseData['message'],
                ];
                return view("v_store/store-detail", $data);
            }
        } catch (\Exception $e) {
            $data = [
                'title' => 'Detail Place',
                'navbar' => $this->getNavbar(),
                'status' => 'error',
            ];
            return view("v_store/store-detail", $data);
        }
    }

    public function scanMaster($scan)
    {
        $data = [
            'title' => 'ScanMaster ' . $scan,
            'navbar' => $this->getNavbar(),
            'target' => $scan,
            'token' => $this->session->get('user_token'),
            'urlUp' => $this->apiUrl . $scan . 's',
            'urlId' => $this->apiUrl . $scan . 's/name',
        ];

        return view("v_scanmaster/scanner", $data);
    }

    public function getScan($target, $imageNane)
    {
        try {
            $idTarget = $this->getIdImage($imageNane, $target);
            if ($idTarget) {
                $scanImage = $this->scanImage($idTarget, $target);

                if ($scanImage) {
                    $data = [
                        'status' => 'success',
                        'dataImage' => $this->fileUrl . $target . 's/detect/' . $scanImage['dataImage'],
                        'totalDetections' => $scanImage['totalDetections']
                    ];
                }
            } else {
                $data = [
                    'status' => 'error',
                    'message' => 'Error uploading file',
                ];
            }
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            $data = [
                'status' => 'error',
                'message' => 'An error occurred. Please try again',
            ];
            return $this->response->setJSON($data);
        }
    }

    public function getIdImage($name, $target)
    {
        try {
            $url = $this->apiUrl . $target . 's/name/' . $name;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                return $responseData['id'];
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function scanImage($idTarget, $target)
    {
        try {
            $url = $this->apiUrl . $target . 's/' . $idTarget;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $result = [
                    'dataImage' => $responseData['resultFileName'],
                    'totalDetections' => $responseData['totalDetections']
                ];
                return $result;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function historyScan($target)
    {
        try {
            $userToken = $this->session->get('user_token');
            $url = $this->apiUrl . $target . 's';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'Authorization:' . $userToken,
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';
            if ($success) {
                $data = [
                    'title' => 'ScanMaster ' . ucfirst($target),
                    'navbar' => $this->getNavbar(),
                    'target' => $target,
                    'resData' => $responseData['data'],
                    'urlOri' => $this->fileUrl . $target . 's/original/',
                    'urlDetect' => $this->fileUrl . $target . 's/detect/'
                ];
                return view("v_history/history", $data);
            } else {
                $this->session->setFlashdata('error', $responseData['message']);
                return redirect()->to('app');
            }
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'An error occurred. Please try again');
            return redirect()->to('app');
        }
    }

    public function deleteTarget($target, $id)
    {
        try {
            $url = $this->apiUrl . $target . 's/' . $id;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $responseBody = curl_exec($ch);

            curl_close($ch);

            $responseData = json_decode($responseBody, true);
            $success = $responseData['status'] === 'success';

            if ($success) {
                $this->session->setFlashdata('success', $responseData['message']);
                return redirect()->to('app/history/' . $target);
            } else {
                $this->session->setFlashdata('error', $responseData['message'] ?? 'An error occurred. Please try again');
                return redirect()->to('app/history/' . $target);
            }
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'An error occurred. Please try again');
            return redirect()->to('app/history/' . $target);
        }
    }
}
