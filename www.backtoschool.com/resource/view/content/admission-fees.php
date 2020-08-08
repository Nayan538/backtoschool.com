<?php
## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$ajaxcontrol = new AjaxController;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [I]NSERT DATA ===*=== ##
if(isset($_POST['addAdmissionFee']))
{
    $tableName = "ems_admission_fees";
    $columnValue["student_id"] = $_POST['student'];
    $columnValue["admission_fees"] = $_POST['admissionFee'];
    $columnValue["application_form_fees"] = $_POST['appFormFee'];
    $columnValue["id_card_fees"] = $_POST['idCardFee'];
    $columnValue["library_fees"] = $_POST['libraryFee'];
    $columnValue["other_fees"] = $_POST['otherFee'];
    $columnValue["total_fees_amount"] = $_POST['totalAmount'];
    $columnValue["created_at"] = date('Y-m-d H:i:s');
    $insertAdmissionFeesData = $eloquent->insertData($tableName, $columnValue);
}
## ===*=== [I]NSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Student Data
$columnName = $tableName = null;
$columnName["1"] = "id";
$columnName["2"] = "first_name";
$columnName["3"] = "last_name";
$tableName = "ems_students";
$fetchStudentData = $eloquent->selectData($columnName, $tableName);

#Fetch Admission Fees Data
$columnName = $tableName = null;
$columnName = "*";
$tableName = "ems_admission_fees";
$fetchAdmissionFeesData = $eloquent->selectData($columnName, $tableName);

#Fetch Organization Configuration Data
$columnName = $tableName = null;
$columnName["1"] = "currency";
$tableName = "ems_org_config";
$fetchOrgConfigData = $eloquent->selectData($columnName, $tableName);

if(!empty($fetchOrgConfigData))
{
    #Define Currency
    if($fetchOrgConfigData[0]['currency'] == 'BDT') {
        $currency = '&#2547';
    } else if ($fetchOrgConfigData[0]['currency'] == 'USD') {
        $currency = '&#36';
    } else if ($fetchOrgConfigData[0]['currency'] == 'EUR') {
        $currency = '&euro';
    }
}
## ===*=== [F]ETCH DATA ===*=== ##
?>

<!--=*= |#| ADMISSION FEES CONTENT |#| =*=-->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <h5 class="text-uppercase">EMS <span style="font-weight: 300;"> Student Admission Fees</span></h5>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                    <ul class="list-inline breadcrumb float-right">
                        <li class="list-inline-item"> <a href="dashboard.php"> Home </a> </li>
                        <li class="list-inline-item"> <a href="#"> Accounts </a> </li>
                        <li class="list-inline-item"> <a href="#"> Student Fees </a> </li>
                        <li class="list-inline-item"> Admission Fees </li>
                    </ul>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="table-responsive card-box">
                    <table class="table table-hover table-sm">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 25%;" class="text-secondary"> Student Name </th>
                                <th style="width: 12%;" class="text-secondary"> Student ID </th>
                                <th style="width: 6%;" class="text-secondary"> Roll No </th>
                                <th style="width: 9%; font-weight: 500;" class="text-info"> Admission Fee </th>
                                <th style="width: 9%; font-weight: 500;" class="text-info"> App. Form Fee </th>
                                <th style="width: 9%; font-weight: 500;" class="text-info"> ID Card Fee </th>
                                <th style="width: 9%; font-weight: 500;" class="text-info"> Library Fee </th>
                                <th style="width: 9%; font-weight: 500;" class="text-info"> Others Fee </th>
                                <th style="width: 9%;" class="text-secondary"> Total Amount </th>
                                <th style="width: 5%;" class="text-secondary"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="post">
                                <tr id="form">
                                    <td> 
                                        <select class="custom-select" name="student" id="student" required>
                                            <option> Choose... </option>

                                            <?php
                                            foreach ($fetchStudentData AS $eachStudent) 
                                            {
                                                $fullName = $eachStudent['first_name'] .' '. $eachStudent['last_name'];
                                                echo '<option value="'. $eachStudent['id'] .'">'. $fullName .'</option>';
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control bg-light" id="getID" value="" style="height: 38px;" readonly> 
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control bg-light" id="getRoll" value="" style="height: 38px;" readonly>
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control amount" name="admissionFee" style="height: 38px;">
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control amount" name="appFormFee" style="height: 38px;">
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control amount" name="idCardFee" style="height: 38px;">
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control amount" name="libraryFee" style="height: 38px;">
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control amount" name="otherFee" style="height: 38px;">
                                    </td>
                                    <td> 
                                        <input type="text" class="form-control bg-light text-center font-weight-bold" name="totalAmount" id="totalAmount" value="" style="height: 38px;" readonly>
                                    </td>
                                    <td class="text-right">
                                        <button type="submit" class="btn btn-outline-success" name="addAdmissionFee">
                                            <i class="fas fa-plus-circle fa-lg mt-1"></i> Add
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            
        <div class="content-page">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm cstmDatatable" style="margin-top: 15px !important;">
                            <thead>
                                <tr>
                                    <th style="width: 4%"> # </th>
                                    <th style="width: 18%"> Student Name </th>
                                    <th style="width: 10%"> Student ID </th>
                                    <th style="width: 4%"> Roll </th>
                                    <th style="width: 8%"> Admission </th>
                                    <th style="width: 8%"> App. Form </th>
                                    <th style="width: 8%"> ID Card </th>
                                    <th style="width: 8%"> Library </th>
                                    <th style="width: 8%"> Others </th>
                                    <th style="width: 10%"> Total Amount </th>
                                    <th style="width: 14%"> Date </th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            #Table Data Content
                            if(!empty($fetchAdmissionFeesData))
                            {
                                $n = 1;
                                foreach ($fetchAdmissionFeesData AS $eachRow) 
                                {
                                    #Fetch Student Data
                                    $columnName = $tableName = $whereValue = null;
                                    $columnName["1"] = "student_id";
                                    $columnName["2"] = "first_name";
                                    $columnName["3"] = "last_name";
                                    $columnName["4"] = "roll_number";
                                    $tableName = "ems_students";
                                    $whereValue["id"] = $eachRow['student_id'];
                                    $fetchStudentTableData = $eloquent->selectData($columnName, $tableName, @$whereValue);
                                    $studentFullName = $fetchStudentTableData[0]['first_name'] .' '. $fetchStudentTableData[0]['last_name'];

                                    echo'
                                    <tr>
                                        <td>'. $n .'</td>
                                        <td>'. $studentFullName .'</td>
                                        <td>'. $fetchStudentTableData[0]['student_id'] .'</td>
                                        <td class="font-weight-bold text-info">'. $fetchStudentTableData[0]['roll_number'] .'</td>
                                        <td>'. $eachRow['admission_fees'] .' '. $currency.'</td>
                                        <td>'. $eachRow['application_form_fees'] .' '. $currency.'</td>
                                        <td>'. $eachRow['id_card_fees'] .' '. $currency.'</td>
                                        <td>'. $eachRow['library_fees'] .' '. $currency.'</td>
                                        <td>'. $eachRow['other_fees'] .' '. $currency.'</td>
                                        <td>'. $eachRow['total_fees_amount'] .' '. $currency .'</td>
                                        <td>'. $ajaxcontrol->dateTime($eachRow['created_at']) .'</td>
                                    </tr>
                                    ';
                                    $n++;
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=*= |#| ADMISSION FEES CONTENT |#| =*=-->


<!--=*= |#| JS SCRIPT |#| =*=-->
<script type="text/javascript">
    $(document).ready(function() {

        //Get The Calculation On Keyup
        $('#form').on('keyup', function() {
            totalAmount();
        });


        //Calculation Function
        var totalAmount = function() {
            var sum = 0;
            $('.amount').each(function() {
                var num = $(this).val();
                if(num != '') {
                    sum += parseFloat(num);
                }
            });
            $('#totalAmount').val(sum);
        }


        //Get Student ID and Roll No
        $('#student').on('change', function() {
            var studentID = $(this).val();

            $.ajax({
                url: 'ajax/examMarkSheet.php',
                type: 'POST',
                data: {action: "STUDENTID", student:studentID},
                success: function(data) {
                    document.getElementById('getID').value = data;
                }   
            }); 

            $.ajax({
                url: 'ajax/examMarkSheet.php',
                type: 'POST',
                data: {action: "ROLLNO", student:studentID},
                success: function(data) {
                    document.getElementById('getRoll').value = data;
                }   
            });
        });
    });
</script>
<!--=*= |#| JS SCRIPT |#| =*=-->