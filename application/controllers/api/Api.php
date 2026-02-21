<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

use \Firebase\JWT\Key;

class Api extends CI_Controller
{
    private $jwt_secret = 'b8d2f4e5a9c7d3b1f6e8a2c4d5f9b0a7e1c3f2d496ab89ce07df12345678abcd';

    public function __construct()
    {

        parent::__construct();

        $this->load->model('general_model');

        $this->load->helper(['url', 'form']);


        header("Access-Control-Allow-Origin: *");
        require_once FCPATH . 'vendor/autoload.php';


        header("Content-Type: application/json; charset=UTF-8");
        $this->load->library('email');
    }

    public function getSubCategories()
    {
        header('Content-Type: application/json');

        try {

            $parent_id = (int) $this->input->get('parent_id');
            $search = trim((string) $this->input->get('search'));

            if ($parent_id <= 0) {
                return $this->output->set_status_header(400)->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'parent_id is required',
                    'data' => []
                ]));
            }

            // ⭐ STEP 1 → GET SUBCATEGORIES
            $subcategories = $this->db
                ->select('id,name,image')
                ->from('categories')
                ->where('isActive', 1)
                ->where('parent_id', $parent_id)
                ->order_by('name', 'ASC')
                ->get()
                ->result_array();

            if (empty($subcategories)) {
                return $this->output->set_status_header(200)->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No subcategories found',
                    'data' => []
                ]));
            }

            $result = [];

            foreach ($subcategories as $subcat) {

                // ⭐ CATEGORY NAME MATCH
                $category_match = false;
                if (!empty($search)) {
                    if (mb_stripos($subcat['name'], $search) !== false) {
                        $category_match = true;
                    }
                }

                // ⭐ GET CHILD CATEGORIES
                $children = $this->db
                    ->select('id')
                    ->from('categories')
                    ->where('isActive', 1)
                    ->where('parent_id', $subcat['id'])
                    ->get()
                    ->result_array();

                $category_ids = array_column($children, 'id');
                $category_ids[] = $subcat['id'];

                // ⭐ SONG SEARCH
                $this->db->from('songs');
                $this->db->where('isActive', 1);
                $this->db->where_in('category_id', $category_ids);

                if (!empty($search)) {
                    $this->db->group_start();
                    $this->db->like('title', $search);
                    $this->db->or_like('description', $search);
                    $this->db->group_end();
                }

                $song_count = $this->db->count_all_results();

                // ⭐ FINAL FILTER
                if (!empty($search)) {
                    if (!$category_match && $song_count == 0) {
                        continue;
                    }
                }

                $result[] = [
                    'id' => (int) $subcat['id'],
                    'name' => $subcat['name'],
                    'image' => !empty($subcat['image']) ? base_url($subcat['image']) : '',
                    'total_songs' => (int) $song_count
                ];
            }
            // ⭐ STEP 7 → NOT FOUND MESSAGE
            if (!empty($search) && empty($result)) {
                return $this->output->set_status_header(200)->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'This song is not found in this category',
                    'data' => []
                ]));
            }

            return $this->output->set_status_header(200)->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'data' => $result
            ], JSON_UNESCAPED_UNICODE));

        } catch (Exception $e) {
            return $this->output->set_status_header(500)->set_output(json_encode([
                'status' => false,
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ]));
        }
    }




    public function getSong()
    {
        // Get category ID from GET params
        $category_id = $this->input->get('id');

        // Validate input
        if (empty($category_id)) {
            echo json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Category ID is required',
                'data' => []
            ]);
            return;
        }

        // Fetch songs by category_id
        $conditions = ['category_id' => $category_id];
        $songs = $this->general_model->getAll('songs', $conditions);

        if (!empty($songs)) {
            $result = [];
            foreach ($songs as $song) {
                $result[] = [
                    'id' => $song->id,
                    'title' => $song->title,
                    // 'description' => $song->description,
                    // 'created_on'  => $song->created_on
                ];
            }

            echo json_encode([
                'code' => 200,
                'status' => true,
                'data' => $result
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'code' => 404,
                'status' => false,
                'message' => 'No songs found for this category',
                'data' => []
            ]);
        }
    }

    public function song_details()
    {
        // Get song ID from GET params
        $song_id = $this->input->get('id');

        // Validate input
        if (empty($song_id)) {
            echo json_encode([
                'code' => 400,
                'status' => false,
                'message' => 'Song ID is required',
                'data' => []
            ]);
            return;
        }

        // Fetch song details
        $song = $this->general_model->getOne('songs', ['id' => $song_id]);

        if (!empty($song)) {
            $result = [
                'title' => $song->title,
                'description' => $song->description,

            ];

            echo json_encode([
                'code' => 200,
                'status' => true,
                'message' => 'Song details fetched successfully',
                'data' => $result
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'code' => 404,
                'status' => false,
                'message' => 'Song not found',
                'data' => []
            ]);
        }
    }

    public function login()
    {
        header('Content-Type: application/json');

        // Read raw JSON input
        $raw = $this->input->raw_input_stream;
        $input_data = json_decode($raw, true);

        // If empty JSON, return error
        if (empty($input_data)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No input data provided',
                    'data' => null
                ]));
        }

        // Extract mobile
        $mobile = trim($input_data['mobile'] ?? '');

        if (empty($mobile)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Mobile number is required',
                    'data' => null
                ]));
        }

        // Find user by mobile
        $user = $this->db->get_where('users', ['mobile' => $mobile])->row();

        if (!$user) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No user found with this mobile number',
                    'data' => null
                ]));
        }

        // Check active status
        if ((int) $user->isActive !== 1) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Your account is not active',
                    'data' => null
                ]));
        }

        // Generate token
        $token = $this->generate_jwt($user);

        // Success response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'mobile' => $user->mobile,
                        'role' => $user->role,
                    ]
                ]
            ]));
    }

    public function register()
    {
        header('Content-Type: application/json');

        // Read JSON raw input
        $raw = $this->input->raw_input_stream;
        $input_data = json_decode($raw, true);

        // If JSON is empty, try POST (form-data, urlencoded)
        if (empty($input_data) && !empty($_POST)) {
            $input_data = $_POST;
        }

        // If still empty → error
        if (empty($input_data)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No input data provided',
                    'data' => null
                ]));
        }

        // Extract fields
        $name = trim($input_data['name'] ?? '');
        $mobile = trim($input_data['mobile'] ?? '');

        // Validation
        if (empty($name) || empty($mobile)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'name and mobile are required',
                    'data' => null
                ]));
        }

        // Duplicate check
        $existing = $this->db->get_where('users', ['mobile' => $mobile])->row();
        if ($existing) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'User already exists',
                    'data' => null
                ]));
        }

        // Insert user
        $insertData = [
            'name' => $name,
            'mobile' => $mobile,
            'role' => 0,
            'isActive' => 1,
            'created_on' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('users', $insertData);
        $user_id = $this->db->insert_id();

        // Generate token
        $user_data = $this->db->get_where('users', ['id' => $user_id])->row();
        $token = $this->generate_jwt($user_data);

        // Success response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'User registered successfully',
                'token' => $token,
                'data' => [
                    'name' => $name,
                    'mobile' => $mobile,
                    'isActive' => 1,
                    'role' => 0
                ]
            ]));
    }

    public function list_song()
    {
        header('Content-Type: application/json');

        // Get token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // Verify token
        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }

        // Fetch active songs with ID + Title
        $query = $this->db
            ->select('id, title')
            ->from('songs')
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get();

        $songs = $query->result();

        if (empty($songs)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'No active songs found',
                    'data' => []
                ]));
        }

        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Song list fetched successfully',
                'data' => $songs
            ]));
    }

    public function search_song()
    {
        header('Content-Type: application/json');

        // Read Bearer Token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // Verify Token
        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output
                ->set_status_header(401)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }

        // Read search parameter from URL
        $search = $this->input->get('query');
        if (empty($search)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Search query is required',
                    'data' => []
                ]));
        }

        // Fetch matching active songs
        $query = $this->db
            ->select('id, title')
            ->from('songs')
            ->like('title', $search)
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get();

        $songs = $query->result();

        // If no results
        if (empty($songs)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No songs found',
                    'data' => []
                ]));
        }

        // Success response
        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Search results fetched successfully',
                'data' => $songs
            ]));
    }


    public function add_favorite()
    {
        header('Content-Type: application/json');

        // Extract token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);

        if (!$decoded) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid token',
                'data' => null
            ]));
        }

        $user_id = (int) $decoded->data->id;

        // Input JSON
        $input = json_decode($this->input->raw_input_stream, true);
        $song_id = $input['song_id'] ?? 0;

        if (!$song_id) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Song ID required',
                'data' => null
            ]));
        }

        // Check song exists + active
        $song = $this->db
            ->where('id', $song_id)
            ->where('isActive', 1)
            ->get('songs')
            ->row();

        if (!$song) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Song not found or inactive',
                'data' => null
            ]));
        }

        // Check if already added
        $exists = $this->db->get_where('user_favorites', [
            'user_id' => $user_id,
            'song_id' => $song_id
        ])->row();

        if ($exists) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Already in favorite list',
                'data' => null
            ]));
        }

        // Add to favorites
        $this->db->insert('user_favorites', [
            'user_id' => $user_id,
            'song_id' => $song_id,
            'created_on' => date('Y-m-d H:i:s')
        ]);

        return $this->output->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Song added to favorites successfully',
            'data' => null
        ]));
    }

    public function list_favorite_songs()
    {
        header('Content-Type: application/json');

        // Read Bearer token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // Verify token
        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid token',
                'data' => null
            ]));
        }

        $user_id = (int) $decoded->data->id;

        // Fetch favorite songs including song_id
        $favorites = $this->db->select('songs.id as song_id, songs.title')
            ->from('user_favorites')
            ->join('songs', 'songs.id = user_favorites.song_id')
            ->where('user_favorites.user_id', $user_id)
            ->where('songs.isActive', 1)
            ->order_by('user_favorites.id', 'DESC')
            ->get()
            ->result();

        if (empty($favorites)) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'No favorite songs found',
                'data' => []
            ]));
        }

        // Format result: return song id + title
        $song_list = array_map(function ($row) {
            return [
                'song_id' => (int) $row->song_id,
                'title' => $row->title
            ];
        }, $favorites);

        return $this->output->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Favorite songs fetched successfully',
            'data' => $song_list
        ]));
    }

    public function profile()
    {
        header('Content-Type: application/json');

        // Read Bearer token
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        // Verify token
        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'Invalid token',
                'data' => null
            ]));
        }

        $user_id = (int) $decoded->data->id;

        // Fetch user from DB
        $user = $this->db->select('name, mobile')
            ->where('id', $user_id)
            ->get('users')
            ->row_array();

        if (!$user) {
            return $this->output->set_output(json_encode([
                'status' => false,
                'code' => 400,
                'message' => 'User not found',
                'data' => null
            ]));
        }


        return $this->output->set_output(json_encode([
            'status' => true,
            'code' => 200,
            'message' => 'Profile fetched successfully',
            'data' => [
                'name' => $user['name'],
                'mobile' => $user['mobile']
            ]
        ]));
    }


    private function verify_jwt($token)
    {
        if (empty($token)) {
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Authorization header missing or invalid',
                    'data' => null
                ]))
                ->_display();
            exit;
        }

        try {
            $decoded = JWT::decode($token, new Key($this->jwt_secret, 'HS256'));

            // 🔹 Check if token is blacklisted
            $query = $this->db->get_where('token_blacklist', ['token' => $token]);
            if ($query->num_rows() > 0) {
                $this->output
                    ->set_status_header(401)
                    ->set_content_type('application/json')
                    ->set_output(json_encode([
                        'status' => false,
                        'code' => 400,
                        'message' => 'Token has been invalidated. Please log in again.',
                        'data' => null
                    ]))
                    ->_display();
                exit;
            }


            return $decoded;
        } catch (Exception $e) {
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Invalid token: ' . $e->getMessage(),
                    'data' => null
                ]))
                ->_display();
            exit;
        }
    }

    private function generate_jwt($user)
    {
        $payload = [
            'iss' => base_url(),
            'iat' => time(),
            'exp' => time() + (365 * 24 * 60 * 60), // 1 year expiry


            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email ?? '',
                'mobile' => $user->mobile,
                'store_name' => $user->gym_name ?? '',
                'role' => $user->role ?? '0'
            ]
        ];
        return JWT::encode($payload, $this->jwt_secret, 'HS256');
    }


    public function search_category()
    {
        header('Content-Type: application/json');

        // ================= TOKEN CHECK =================
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output
                ->set_status_header(401)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }


        $search = trim((string) $this->input->get('query'));
        $category_id = trim((string) $this->input->get('id'));

        // ================= VALIDATION =================
        if (empty($category_id) && empty($search)) {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Category id or search query is required',
                    'data' => []
                ]));
        }


        if (!empty($category_id)) {

            // 🔹 Search strictly by ID
            $category = $this->db
                ->where('id', $category_id)
                ->where('isActive', 1)
                ->get('categories')
                ->row_array();
        } else {

            // 🔹 Search by name
            $category = $this->db
                ->like('name', $search)
                ->where('isActive', 1)
                ->get('categories')
                ->row_array();
        }

        if (!$category) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No category found',
                    'data' => []
                ]));
        }


        $songs = $this->db
            ->select('id, title')
            ->from('songs')
            ->where('category_id', $category['id'])
            ->where('isActive', 1)
            ->order_by('id', 'DESC')
            ->get()
            ->result();


        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Category fetched successfully',
                'data' => [
                    'category' => [
                        'id' => (int) $category['id'],
                        'name' => $category['name'],
                        'image' => !empty($category['image'])
                            ? base_url($category['image'])
                            : ''
                    ],
                    'total_songs' => count($songs),
                    'songs' => $songs
                ]
            ], JSON_UNESCAPED_UNICODE));
    }



    public function song_search()
    {
        header('Content-Type: application/json');

        // ================= TOKEN CHECK =================
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);
        if (!$decoded || empty($decoded->data->id)) {
            return $this->output
                ->set_status_header(401)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Invalid or missing token',
                    'data' => null
                ]));
        }

        // ================= GET PARAMETERS =================
        $search = trim((string) ($this->input->get('query') ?? ''));
        $category_id = trim((string) ($this->input->get('category_id') ?? ''));

        if ($search === '') {
            return $this->output
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Search query is required',
                    'data' => []
                ]));
        }

        // ================= BUILD QUERY =================
        $this->db->select('id, title, category_id');
        $this->db->from('songs');
        $this->db->where('isActive', 1);
        $this->db->group_start()
            ->like('title', $search)
            ->or_like('description', $search)
            ->group_end();

        if ($category_id !== '') {
            $this->db->where('category_id', $category_id);
        }

        $songs = $this->db
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        if (empty($songs)) {
            return $this->output
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => true,
                    'code' => 200,
                    'message' => 'No songs found',
                    'data' => []
                ]));
        }


        return $this->output
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Song search results fetched successfully',
                'data' => $songs
            ], JSON_UNESCAPED_UNICODE));
    }





    public function get_certificates()
    {
        header('Content-Type: application/json');


        try {

            $rows = $this->db
                ->select('id,title,image')
                ->where('isActive', 1)   // only active
                ->order_by('id', 'DESC')
                ->get('certificates')
                ->result_array();

            $data = [];

            foreach ($rows as $row) {

                $data[] = [
                    'id' => (int) $row['id'],
                    'title' => $row['title'],
                    'image' => !empty($row['image']) ? base_url($row['image']) : ''
                ];
            }

            echo json_encode([
                'status' => true,
                'code' => 200,
                'data' => $data
            ]);
        } catch (Exception $e) {

            echo json_encode([
                'status' => false,
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function add_suggestion()
    {
        header('Content-Type: application/json');

        try {

            // ================= TOKEN =================
            $authHeader = $this->input->get_request_header('Authorization', TRUE);

            // fallback for apache / CI header issue
            if (!$authHeader && isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
            }

            $token = null;

            if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $token = $matches[1];
            }

            if (!$token) {
                echo json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Token missing'
                ]);
                return;
            }

            // ================= VERIFY =================
            $decoded = $this->verify_jwt($token);

            // ⭐ IMPORTANT → your JWT structure
            if (!$decoded || empty($decoded->data->id)) {
                echo json_encode([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Invalid token'
                ]);
                return;
            }

            // ================= USER =================
            $user_id = (int) $decoded->data->id;

            $user = $this->db
                ->where('id', $user_id)
                ->get('users')
                ->row();

            if (!$user) {
                echo json_encode([
                    'status' => false,
                    'code' => 404,
                    'message' => 'User not found'
                ]);
                return;
            }

            // ================= INPUT =================
            $message = trim($this->input->post('message'));

            if ($message === '') {
                echo json_encode([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Message required'
                ]);
                return;
            }

            // ================= INSERT =================
            $this->db->insert('suggestions', [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'message' => $message,
                'created_on' => date('Y-m-d H:i:s')
            ]);

            echo json_encode([
                'status' => true,
                'code' => 200,
                'message' => 'Suggestion submitted successfully'
            ]);
        } catch (Exception $e) {

            echo json_encode([
                'status' => false,
                'code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function profile_details()
    {
        $this->output->set_content_type('application/json');

        // ================= TOKEN =================
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);

        if (!$decoded || empty($decoded->data->id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid token'
            ]);
            return;
        }

        $user_id = (int) $decoded->data->id;

        // ================= RAW JSON =================
        $raw = json_decode($this->input->raw_input_stream, true);

        // ================= UPDATE ARRAY =================
        $update = [];
        $fields = ['name', 'email', 'business', 'address', 'taluka', 'district', 'pincode'];

        foreach ($fields as $field) {

            // JSON support
            if (isset($raw[$field])) {
                $update[$field] = $raw[$field];
            }

            // FORM support
            elseif ($this->input->post($field) !== null) {
                $update[$field] = $this->input->post($field);
            }
        }

        // ================= TEXT UPDATE =================
        if (!empty($update)) {
            $this->db->where('id', $user_id)->update('users', $update);
        }

        // ================= PHOTO UPLOAD =================
        if (!empty($_FILES['photo']['name'])) {

            $config['upload_path'] = './uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {

                // delete old photo
                $old = $this->db->where('id', $user_id)->get('users')->row();
                if (!empty($old->photo) && file_exists('./uploads/profile/' . $old->photo)) {
                    unlink('./uploads/profile/' . $old->photo);
                }

                $file = $this->upload->data();
                $this->db->where('id', $user_id)->update('users', ['photo' => $file['file_name']]);

            } else {
                echo json_encode([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }

        // ================= FETCH USER =================
        $user = $this->db->where('id', $user_id)->get('users')->row();

        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'User not found']);
            return;
        }

        // hide password
        unset($user->password);

        // photo URL
        if (!empty($user->photo)) {
            $user->photo = base_url('uploads/profile/' . $user->photo);
        }

        echo json_encode([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }
    public function profile_details_get()
    {
        $this->output->set_content_type('application/json');

        // ================= TOKEN =================
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);

        if (!$decoded || empty($decoded->data->id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid token'
            ]);
            return;
        }

        $user_id = (int) $decoded->data->id;

        $user = $this->db->where('id', $user_id)->get('users')->row();

        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'User not found']);
            return;
        }

        // hide password
        unset($user->password);

        // photo URL
        if (!empty($user->photo)) {
            $user->photo = base_url('uploads/profile/' . $user->photo);
        }

        echo json_encode([
            'status' => true,
            'data' => $user
        ]);
    }
    public function add_user_song()
    {
        header('Content-Type: application/json');

        try {

            // ================= TOKEN VALIDATION =================
            $authHeader = $this->input->get_request_header('Authorization', TRUE);
            $token = null;

            if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $token = $matches[1];
            }

            $decoded = $this->verify_jwt($token);

            if (!$decoded || empty($decoded->data->id)) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Invalid token'
                ]);
                return;
            }

            $user_id = (int) $decoded->data->id;


            // ================= USER FETCH =================
            $user = $this->db
                ->select('id,name')
                ->where('id', $user_id)
                ->get('users')
                ->row();

            if (!$user) {
                echo json_encode([
                    'status' => false,
                    'message' => 'User not found'
                ]);
                return;
            }

            $user_name = $user->name;


            // ================= INPUT =================
            $title = trim($this->input->post('title'));
            $description = $this->input->post('description', FALSE);

            if (empty($title)) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Title required'
                ]);
                return;
            }


            // ================= DUPLICATE CHECK =================
            // reject songs ignore (status=2)
            $duplicate = $this->db
                ->where('LOWER(title)', strtolower($title))
                ->where('status !=', 2)
                ->get('songs')
                ->row();

            if ($duplicate) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Song already exists'
                ]);
                return;
            }


            // ================= INSERT =================
            $insert = $this->db->insert('songs', [
                'title' => $title,
                'description' => $description,
                'user_id' => $user_id,
                'user_name' => $user_name,
                'status' => 0, // pending
                'isActive' => 1,
                'created_on' => date('Y-m-d H:i:s')
            ]);


            if (!$insert) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Failed to submit song'
                ]);
                return;
            }


            // ================= SUCCESS =================
            echo json_encode([
                'status' => true,
                'message' => 'Song submitted for approval',
                'data' => [
                    'title' => $title,
                    'user' => $user_name
                ]
            ]);

        } catch (Exception $e) {

            echo json_encode([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function my_song_status()
    {
        header('Content-Type: application/json');

        // ===== TOKEN =====
        $authHeader = $this->input->get_request_header('Authorization', TRUE);
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $decoded = $this->verify_jwt($token);

        if (!$decoded || empty($decoded->data->id)) {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid token'
            ]);
            return;
        }

        $user_id = $decoded->data->id;

        // ===== FETCH SONGS =====
        $songs = $this->db
            ->select('id,title,description,status,created_on')
            ->where('user_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('songs')
            ->result();

        // ===== ADD STATUS TEXT =====
        foreach ($songs as $s) {

            if ($s->status == 0)
                $s->status_text = "Pending";
            if ($s->status == 1)
                $s->status_text = "Approved";
            if ($s->status == 2)
                $s->status_text = "Rejected";
        }

        echo json_encode([
            'status' => true,
            'message' => 'Song list',
            'data' => $songs
        ]);
    }
}
