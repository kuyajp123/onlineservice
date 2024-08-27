                            
                            <?php
                            
                            $sql = "select * from user_registration where user_no = ?";
                            $stmt = $con->prepare($sql);
                            $stmt->bind_param('i', $_SESSION['user_no']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            $timestamp = htmlspecialchars($row['bday']);
                            $bday = new DateTime($timestamp);
                            $formattedDate = $bday->format('F j, Y'); // e.g., July 24, 2023

                            $query = "SELECT info_name, is_hidden FROM user_info_visibility WHERE user_no = ? AND info_name IN ('bday', 'gender')";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('i', $_SESSION['user_no']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $visibility = [
                                'bday' => 0,
                                'gender' => 0
                            ];

                            while ($row1 = $result->fetch_assoc()) {
                                $visibility[$row1['info_name']] = $row1['is_hidden'];
                            }
                            ?>
                            
                            
                            
                            <div class="container-fluid edicont">
                                <div class="container-fluid editdetails">Personal Information</div>                                
                                <div class="container-fluid nameedit">
                                    <div>Name</div>
                                    <div><?php echo "".$row['fname']." ".$row['lname']." " ?><a href="#" data-open-modal="editname"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid usernameedit">
                                    <div>Username</div>
                                    <div><?php echo $row['user_ID'] ?> <a href="#" data-open-modal="editusername"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid birthdate">
                                    <div>Birthdate</div>
                                    <div><?php
                                    if ($visibility['bday'] == 1) { 
                                        echo " <i class='fa-solid fa-eye-slash'></i> "; 
                                    }
                                    echo $formattedDate ?> <a href="#" data-open-modal="editbirthdate"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid gender">
                                    <div>Gender</div>
                                    
                                    <div>
                                        <?php
                                        $gender = $row['gender'];
                                        if ($visibility['gender'] == 1) {
                                            echo " <i class='fa-solid fa-eye-slash'></i> ";
                                        }

                                        if ($gender == 'prefered-not-to-say') {
                                            echo "Prefered not to say";
                                        } else {
                                            echo $gender;
                                        }
                                        // Check if is_hidden is set to 1, then show the eye-slash icon
                                        
                                        ?>
                                     <a href="#" data-open-modal="editgender"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid lineedit"></div>
                                <div class="container-fluid studentnumedit">
                                    <div>Student Number</div>
                                    <div><?php echo $row['student_no'] ?> <a href="#" data-open-modal="editstdnum"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid email">
                                    <div>CVSU Email</div>
                                    <div><?php echo $row['email'] ?> <a href="#" data-open-modal="editemail"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid password">
                                    <div>Password</div>
                                    <div>********** <a href="#" data-open-modal="editpassword"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                            </div>