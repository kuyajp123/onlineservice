                            
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
                                    <div><?php echo $formattedDate ?> <a href="#" data-open-modal="editbirthdate"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid gender">
                                    <div>Gender</div>
                                    <div><?php echo $row['gender'] ?> <a href="#" data-open-modal="editgender"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid lineedit"></div>
                                <div class="container-fluid password">
                                    <div>Password</div>
                                    <div>********** <a href="#" data-open-modal="editpassword"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                
                                <div class="container-fluid studentnumedit">
                                    <div>Student Number</div>
                                    <div>********** <a href="#" data-open-modal="editstdnum"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                                <div class="container-fluid email">
                                    <div>CVSU Email</div>
                                    <div>********** <a href="#" data-open-modal="editemail"><i class="fa-solid fa-pen-to-square"></i></a></div>
                                </div>
                            </div>