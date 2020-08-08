<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("./../app/Http/Controllers/Controller.php");
include("./../app/Models/Eloquent.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;
## ===*=== [O]BJECT DEFINED ===*=== ##


## ===*=== [D]ELETE DATA ===*=== ##
#Delete Subject Data
if($_POST['action'] == "deleteSubject")
{
    $subject_id = $_POST['id'];

    $tableName = $whereValue = null;
	$tableName = "ems_subjects";
	$whereValue["id"] = $subject_id;
    $deleteSubjectData = $eloquent->deleteData($tableName, $whereValue);
    
    if($deleteSubjectData > 0) {
        echo 1;
    }
}


#Delete Class Data
if($_POST['action'] == "deleteClass")
{
    $classID = $_POST['id'];

	$tableName = $whereValue = null;
	$tableName = "ems_classes";
	$whereValue["id"] = $classID;
	$deleteClassData = $eloquent->deleteData($tableName, $whereValue);
    
    if($deleteClassData > 0) {
        echo 1;
    }
}


#Delete Shift Data
if($_POST['action'] == "deleteShift")
{
    $shiftID = $_POST['id'];

	$tableName = $whereValue = null;
	$tableName = "ems_shifts";
	$whereValue["id"] = $shiftID;
	$deleteShiftData = $eloquent->deleteData($tableName, $whereValue);	
    
    if($deleteShiftData > 0) {
        echo 1;
    }
}


#Delete Semester Data
if($_POST['action'] == "deleteSemester")
{
    $semesterID = $_POST['id'];

	$tableName = $whereValue = null;
	$tableName = "ems_semesters";
	$whereValue["id"] = $semesterID;
	$deleteSemestersData = $eloquent->deleteData($tableName, $whereValue);	

    if($deleteSemestersData > 0) {
        echo 1;
    }
}
## ===*=== [D]ELETE DATA ===*=== ##


## ===*=== [I]INSERT DATA ===*=== ##
#Insert Subject Data
if($_POST['action'] == "insertSUBJECT")
{
    $subjectData = $_POST['nameOfSubject'];
    $subjectCode = $_POST['nameOfCode'];
    
    $tableName = $columnValue = null;
    $tableName = "ems_subjects";
    $columnValue["subject_name"] = $subjectData;
    $columnValue["subject_code"] = $subjectCode;
    $columnValue["created_at"] = date('Y-m-d H:i:s');
    $insertSubjectData = $eloquent->insertData($tableName, $columnValue);

    if($insertSubjectData['LAST_INSERT_ID'] > 0) {
        echo 1;
    }
}


#Insert Class Data
if($_POST['action'] == "insertCLASS")
{
    $classData = $_POST['nameOfClass'];

    $tableName = $columnValue = null;
    $tableName = "ems_classes";
    $columnValue["class_name"] =  $classData;
    $columnValue["created_at"] = date('Y-m-d H:i:s');
    $insertClassData = $eloquent->insertData($tableName, $columnValue);

    if($insertClassData['LAST_INSERT_ID'] > 0) {
        echo 1;
    }
}


#Insert Shift Data
if($_POST['action'] == "insertShift")
{
    $shiftData = $_POST['nameOfShift'];

    $tableName = $columnValue = null;
    $tableName = "ems_shifts";
    $columnValue["shift_name"] = $shiftData;
    $columnValue["created_at"] = date('Y-m-d H:i:s');
    $insertShiftData = $eloquent->insertData($tableName, $columnValue);

    if($insertShiftData['LAST_INSERT_ID'] > 0) {
        echo 1;
    }
}


#Insert Semester Data
if($_POST['action'] == "insertSEMESTER")
{
    $semesterData = $_POST['nameOfSemester'];

    $tableName = $columnValue = null;
    $tableName = "ems_semesters";
    $columnValue["semester_name"] = $semesterData;
    $columnValue["created_at"] = date('Y-m-d H:i:s');
    $insertSemestersData = $eloquent->insertData($tableName, $columnValue);

    if($insertSemestersData['LAST_INSERT_ID'] > 0) {
        echo 1;
    }
}
## ===*=== [I]INSERT DATA ===*=== ##


## ===*=== [F]ETCH DATA ===*=== ##
#Fetch Subject Data | Table Data Content
if($_POST['action'] == "loadSubject")
{    
    $columnName = $tableName = null;
    $columnName = "*";
    $tableName = "ems_subjects";
    $fetchSubjectData = $eloquent->selectData($columnName, $tableName);	

    if(!empty($fetchSubjectData))
    {
        $n = 1;
        foreach($fetchSubjectData AS $eachRow)
        {
            echo '
            <tr>
                <td class="font-weight-bold text-center" style="padding: 3px; 8px;">'. $n .'</td>
                <td style="padding: 3px; 8px;">'. $eachRow['subject_name'] .'</td>
                <td style="padding: 3px; 8px;">'. $eachRow['subject_code'] .'</td>
                <td style="padding: 3px; 8px;" class="text-center">
                    <button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm delete deleteSubject" data-toggle="modal" data-target="#deleteSubject">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            ';
            $n++;
        }
    }
}


#Fetch Class Data | Table Data Content
if($_POST['action'] == "loadClass")
{
    $columnName = $tableName = null;
    $columnName = "*";
    $tableName = "ems_classes";
    $fetchClassData = $eloquent->selectData($columnName, $tableName);	

    if(!empty($fetchClassData))
    {
        $n = 1;
        foreach($fetchClassData AS $eachRow)
        {
            echo '
            <tr>
                <td class="font-weight-bold text-center" style="padding: 3px; 8px;">'. $n .'</td>
                <td style="padding: 3px; 8px;">'. $eachRow['class_name'] .'</td>
                <td style="padding: 3px; 8px;" class="text-center">
                    <button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm deleteClass" data-toggle="modal" data-target="#deleteClass">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            ';
            $n++;
        }												
    }
}


#Fetch Shift Data | Table Data Content
if($_POST['action'] == "loadShift")
{
    $columnName = $tableName = null;
    $columnName = "*";
    $tableName = "ems_shifts";
    $fetchShiftData = $eloquent->selectData($columnName, $tableName);

    if(!empty($fetchShiftData))
    {
        $n = 1;
        foreach($fetchShiftData AS $eachRow)
        {
            echo '
            <tr>
                <td class="font-weight-bold text-center" style="padding: 3px; 8px;">'. $n .'</td>
                <td style="padding: 3px; 8px;">'. $eachRow['shift_name'] .'</td>
                <td style="padding: 3px; 8px;" class="text-center">
                    <button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm deleteShift" data-toggle="modal" data-target="#deleteShift">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            ';
            $n++;
        }												
    }
}


#Fetch Semester Data | Table Data Content
if($_POST['action'] == "loadSemester")
{
    $columnName = $tableName = null;
    $columnName = "*";
    $tableName = "ems_semesters";
    $fetchSemestersData = $eloquent->selectData($columnName, $tableName);

    if(!empty($fetchSemestersData))
    {
        $n = 1;
        foreach($fetchSemestersData AS $eachRow)
        {
            echo '
            <tr>
                <td class="font-weight-bold text-center" style="padding: 3px; 8px;">'. $n .'</td>
                <td style="padding: 3px; 8px;">'. $eachRow['semester_name'] .'</td>
                <td style="padding: 3px; 8px;" class="text-center">
                    <button data-id="'. $eachRow['id'] .'" class="btn btn-outline-danger btn-sm deleteSemesters" data-toggle="modal" data-target="#deleteSemesters">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            ';
            $n++;
        }												
    }
}
## ===*=== [F]ETCH DATA ===*=== ##
?>