Payroll System with a RESTful API in PHP
Here are the essential components of a PHP Payroll System:

Employee Class: An Employee class to represent employee data and manage CRUD operations.

API Endpoint (payroll.php): This is where you handle HTTP requests and interact with the Employee class.

Let's break down the code into these components:

<?php
Employee.php (Employee Class):
class Employee {
    private $employees;

    public function __construct() {
        // Simulated employee data (for demonstration purposes)
        $this->employees = [
            1 => [
                'id' => 1,
                'name' => 'John Doe',
                'position' => 'Software Engineer',
                'salary' => 60000,
            ],
            2 => [
                'id' => 2,
                'name' => 'Jane Smith',
                'position' => 'HR Manager',
                'salary' => 55000,
            ],
        ];
    }

    public function getAllEmployees() {
        return $this->employees;
    }

    public function getEmployeeById($id) {
        return isset($this->employees[$id]) ? $this->employees[$id] : null;
    }

    public function addEmployee($data) {
        $newId = max(array_keys($this->employees)) + 1;
        $data['id'] = $newId;
        $this->employees[$newId] = $data;
        return $newId;
    }

    public function updateEmployee($id, $data) {
        if (isset($this->employees[$id])) {
            $this->employees[$id] = $data;
            return true;
        }
        return false;
    }

    public function deleteEmployee($id) {
        if (isset($this->employees[$id])) {
            unset($this->employees[$id]);
            return true;
        }
        return false;
    }
}

payroll.php (API Endpoint):

require 'Employee.php';

$employeeService = new Employee();

// Set the response content type to JSON
header('Content-Type: application/json');

// Handle HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

// Retrieve all employees
if ($method === 'GET') {
    echo json_encode($employeeService->getAllEmployees());
}

// Retrieve an employee by ID
if ($method === 'GET' && isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    $employee = $employeeService->getEmployeeById($employeeId);
    if ($employee) {
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
}

// Add a new employee
if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $newId = $employeeService->addEmployee($data);
    echo json_encode(['message' => 'Employee added successfully', 'id' => $newId]);
}


// Update an existing employee
if ($method === 'PUT' && isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    $data = json_decode(file_get_contents('php://input'), true);
    if ($employeeService->updateEmployee($employeeId, $data)) {
        echo json_encode(['message' => 'Employee updated successfully']);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
}

// Delete an employee
if ($method === 'DELETE' && isset($_GET['id'])) {
    $employeeId = $_GET['id'];
    if ($employeeService->deleteEmployee($employeeId)) {
        echo json_encode(['message' => 'Employee deleted successfully']);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
}

In this example:

The Employee class handles CRUD operations for employees, and simulated employee data is stored in an array.

The payroll.php file acts as the API endpoint, processing GET, POST, PUT, and DELETE requests for employee data. It interacts with the Employee class to perform these operations.
