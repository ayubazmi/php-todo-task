<?php
// Include the database connection file
include 'db.php';

/**
 * Retrieve all tasks from the database.
 *
 * @param mysqli $conn The database connection.
 * @return mysqli_result|bool The result set from the query, or false on failure.
 */
function getTasks($conn) {
    // SQL query to select all tasks, ordered by creation time in descending order
    $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
    // Execute the query and return the result
    $result = $conn->query($sql);
    
    // Check if query execution was successful
    if ($result === false) {
        die("Error executing query: " . $conn->error);  // Display MySQL error
    }
    
    return $result;
}

/**
 * Add a new task to the database.
 *
 * @param mysqli $conn The database connection.
 * @param string $title The title of the task.
 * @return bool True on success, false on failure.
 */
function addTask($conn, $title) {
    // Prepare the SQL statement for inserting a new task
    $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error); // Handle error in preparing the statement
    }

    // Bind the task title to the SQL statement
    $stmt->bind_param("s", $title);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        return true;
    } else {
        die("Error executing statement: " . $stmt->error); // Handle error in executing the statement
    }
    
    return false;
}

/**
 * Delete a task from the database.
 *
 * @param mysqli $conn The database connection.
 * @param int $id The ID of the task to delete.
 * @return bool True on success, false on failure.
 */
function deleteTask($conn, $id) {
    // Prepare the SQL statement for deleting a task
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error); // Handle error in preparing the statement
    }
    
    // Bind the task ID to the SQL statement
    $stmt->bind_param("i", $id);
    
    // Execute the statement and check for success
    if ($stmt->execute()) {
        return true;
    } else {
        die("Error executing statement: " . $stmt->error); // Handle error in executing the statement
    }

    return false;
}

/**
 * Update a task in the database.
 *
 * @param mysqli $conn The database connection.
 * @param int $id The ID of the task to update.
 * @param string|null $status The new status of the task (optional).
 * @param string|null $title The new title of the task (optional).
 * @return bool True on success, false on failure.
 */
function updateTask($conn, $id, $status = null, $title = null) {
    // Prepare SQL based on whether we are updating status or title
    if ($status !== null) {
        // Prepare the SQL statement for updating the task status
        $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error); // Handle error in preparing the statement
        }

        // Bind the new status and task ID to the SQL statement
        $stmt->bind_param("si", $status, $id);
    } elseif ($title !== null) {
        // Prepare the SQL statement for updating the task title
        $stmt = $conn->prepare("UPDATE tasks SET title = ? WHERE id = ?");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error); // Handle error in preparing the statement
        }

        // Bind the new title and task ID to the SQL statement
        $stmt->bind_param("si", $title, $id);
    }

    // Execute the statement and check for success
    if ($stmt->execute()) {
        return true;
    } else {
        die("Error executing statement: " . $stmt->error); // Handle error in executing the statement
    }
    
    return false;
}
?>
