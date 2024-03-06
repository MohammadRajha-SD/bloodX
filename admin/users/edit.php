<?php
                                        if ($stmt = $connection -> prepare('SELECT * FROM users ORDER BY ASEC student_id')) {
                                            // $calc_page = ($page - 1) * $num_results_on_page;
                                            $stmt -> bind_param('ii', $calc_page, $num_results_on_page);
                                            $stmt -> execute(); 
                                            $result = $stmt -> get_result();
                                            $stmt -> close();
                                        }

                                        if ($result -> num_rows > 0) {
                                            while ($row = $result -> fetch_assoc()) {
                                                ?>
                                                <tr>
                                                <?php
                                                if (isset($_GET['id']) AND $row['student_id'] == $_GET['id']) {
                                                    $studentID = $row['student_id'];
                                                    $fetchNatQuery = "SELECT nationality_id FROM student_nationalities WHERE student_id = '$studentID'";

                                                    $result = mysqli_query($connection, $fetchNatQuery);
                                                    $nationalitiesArray  = mysqli_fetch_array($result);

                                                    echo '<form action="updateStudent.php" method="POST">';
                                                    echo '<td><input  name="id"        style="height: 2rem;" type="hidden" value="'.$studentID.'"></td>';
                                                    echo '<td><input  name="institute" style="height: 2rem;" value="'.$row['institute_id'].'"></td>';
                                                    echo '<td><input  name="name"      style="height: 2rem;" value="'.$row['student_name'].'"></td>';
                                                    echo '<td><input  name="email"     style="height: 2rem;" type="email" value="'.$row['student_email'].'"></td>';
                                                    echo '<td><input  name="phone"     style="height: 2rem;" value="'.$row['student_phone'].'"></td>';
                                                    echo '<td><input  name="address"   style="height: 2rem;" value="'.$row['student_addr'].'"></td>';
                                                    echo '<td><input  name="bday"      style="height: 2rem;" value="'.$row['date_of_birth'].'"></td>';
                                                    echo '<td><input  name="gender"    style="height: 2rem;" value="'.$row['gender'].'"></td>';
                                                    echo '<td><input  name="nationalities"    style="height: 2rem;" value="'.$nationalitiesArray.'"></td>';
                                                    echo '<td><button id="update_btn"  type="submit">update</button></td>';
                                                    echo '</form>';
                                                }
                                            }
                                        }
                                    ?>