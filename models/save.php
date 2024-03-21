<?php

   $registration = array(

      's_app_id' => "'" . $_POST ['inp_app_id']. "'",
      's_award_num'=> "'" .  $_POST ['inp_award_num']. "'",
      's_sid'=>  "'" . $_POST ['inp_sid']. "'",
      's_firstName'=>  "'" . $_POST ['inp_firstName']. "'",
      's_lastName'=>  "'" . $_POST ['inp_lastName']. "'",
      's_extName' => "'" . $_POST ['inp_extName']. "'",
      's_midName'=>  "'" . $_POST ['inp_midName']. "'",
      's_gender' => "'" . $_POST ['inp_gender']. "'",
      's_contNum'=>  "'" . $_POST ['inp_contNum']. "'", 
      's_status'=>  "'" . $_POST ['inp_status']. "'",
      's_batchNum'=>  "'" . $_POST ['inp_batchNum']. "'",     

   );
    
   save($registration);

   function save($data){
      include('../config/database.php');
      
      // Sanitize and escape values to prevent SQL injection
      $sanitizedData = array_map(function($value) use ($conn) {
          return mysqli_real_escape_string($conn, $value);
      }, $data);
  
      $attributes = implode(",", array_keys($sanitizedData));
      $values = "'" . implode("','", array_values($sanitizedData)) . "'";
      $queryInsert = "INSERT IGNORE INTO s_students ($attributes) VALUES ($values)";
  
      if($conn->query($queryInsert) === TRUE){
          if ($conn->affected_rows > 0) {
              $conn->close();
              header('location: /Event-driven-programming/registration.php?success');
              exit();
          } else {
              $conn->close();
              header('location: /Event-driven-programming/registration.php?invalid');
              exit();
          }
      } 

   }
  
  
  