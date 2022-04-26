<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config = [
    'error_prefix' => '<span class="text-danger">',
    'error_suffix' => '</span><br />',
    'employee' => [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'alpha_numeric_spaces' => "%s is invalid",
                'max_length' => "Max 100 characters allowed",
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile Number',
            'rules' => 'required|exact_length[10]|is_natural|is_unique[logins.mobile]|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
                'is_unique' => "%s is already in use.",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|valid_email|is_unique[logins.email]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'valid_email' => "%s is invalid",
                'is_unique' => "%s is already in use.",
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'max_length[100]|required|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required|in_list[Male,Female]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'dob',
            'label' => 'Date Of Birth',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'society',
            'label' => 'Flate No / House No / Socity',
            'rules' => 'required|max_length[50]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
            ],
        ],
        [
            'field' => 'area',
            'label' => 'Area',
            'rules' => 'required|max_length[255]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed.",
            ],
        ],
        [
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'required|exact_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'city',
            'label' => 'City',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'role',
            'label' => 'Apply For',
            'rules' => 'required|in_list[Administrative,Receptionist,Call center,Accountant,Marketing,Phlebetomist]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'marital',
            'label' => 'Marital Status',
            'rules' => 'required|in_list[Unmarried,Married]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'qulification',
            'label' => 'Qulification',
            'rules' => 'required|in_list[10th Standard,12th Standard,Under Graduation,Post Graduation]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'physical',
            'label' => 'Physical Status',
            'rules' => 'required|in_list[Healthy,Handycapt]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'licence',
            'label' => 'Driving Licence',
            'rules' => 'required|in_list[Two Wheeler,Four Wheeler]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'vehicle',
            'label' => 'Have Any Vehicle',
            'rules' => 'required|in_list[Moped,Bike]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'office-time',
            'label' => 'Office Time',
            'rules' => 'required|in_list[Day,Night]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'aadhar',
            'label' => 'Aadhar Card No',
            'rules' => 'required|exact_length[12]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'language[]',
            'label' => 'Language',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ],
];