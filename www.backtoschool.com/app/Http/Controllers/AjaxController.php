<?php
class AjaxController extends Controller
{
	## ===*=== [L]OG IN FUNCTION START ===*=== ##

	//ADMIN LOGIN
	public function tryLogin($table, $column1, $column2, $userEmail, $userPass)
	{
		$sql_code = "SELECT * FROM {$table} WHERE {$column1}=:VALUE1 AND {$column2}=:VALUE2";
		$query = $this->connection->prepare($sql_code);

		$values = array(
			':VALUE1' => $userEmail,
			':VALUE2' => $userPass
		);

		$query->execute($values);
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}


	//ADMIN LOCK SCREEN
	public function tryLockScreen($table, $column, $userPass)
	{
		$sql_code = "SELECT * FROM {$table} WHERE {$column}=:VALUE";
		$query = $this->connection->prepare($sql_code);

		$values = array(
			':VALUE' => $userPass
		);

		$query->execute($values);
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}

	## ===*=== [L]OG IN FUNCTION END ===*=== ##


	## ===*=== [F]ETCH DATA START ===*=== ##

	//GRID VIEW CONTENT SEARCH
	public function searchGridContent($table, $col1, $col2, $searchName)
	{
		$sql_code = "	SELECT * FROM {$table} WHERE {$col1} LIKE '%{$searchName}%' OR {$col2} LIKE '%{$searchName}%'";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}		

	//GRID VIEW CONTENT SEARCH
	public function searchNotice($table, $col1, $col2, $col3, $col4, $searchName)
	{
		$sql_code = "SELECT * FROM {$table} WHERE 
					{$col1} LIKE '%{$searchName}%' OR 
					{$col2} LIKE '%{$searchName}%' OR 
					{$col3} LIKE '%{$searchName}%' OR 
					{$col4} LIKE '%{$searchName}%'";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}		


	//CONTACT LIST DATA
	public function fetchSpecific($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $table)
	{
		$sql_code = "SELECT {$col1}, {$col2}, {$col3}, {$col4}, {$col5}, {$col6}, {$col7}, {$col8}, {$col9} FROM {$table}";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}


	//CONTACT LIST DATA SEARCH
	public function searchSpecific($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9, $table, $searchData)
	{
		$sql_code = "
			SELECT {$col1}, {$col2}, {$col3}, {$col4}, {$col5}, {$col6}, {$col7}, {$col8}, {$col9} 
			FROM {$table} WHERE
			{$col1} LIKE '%{$searchData}%' OR 
			{$col2} LIKE '%{$searchData}%' OR 
			{$col3} LIKE '%{$searchData}%' OR
			{$col4} LIKE '%{$searchData}%' OR
			{$col5} LIKE '%{$searchData}%' OR
			{$col6} LIKE '%{$searchData}%' OR
			{$col7} LIKE '%{$searchData}%' OR
			{$col8} LIKE '%{$searchData}%' OR
			{$col9} LIKE '%{$searchData}%'
		";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}


	//GET DATA FOR EDIT ONLY BASED ON ID
	public function getData($table, $getId)
	{
		$sql_code = "SELECT * FROM {$table} WHERE id = {$getId}";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}


	//DESENDING ORDER
	public function fetchDesc($table, $col)
	{
		$sql_code = "SELECT * FROM {$table} ORDER BY {$col} DESC";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}


	//DESENDING ORDER ON LIMIT
	public function fetchLimit($table, $col, $num)
	{
		$sql_code = "SELECT * FROM {$table} ORDER BY {$col} DESC LIMIT {$num}";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}	


	//ASSENDING ORDER
	public function fetchAsc($table, $col)
	{
		$sql_code = "SELECT * FROM {$table} ORDER BY {$col} ASC";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}

	## ===*=== [F]ETCH DATA END ===*=== ##


	## ===*=== [D]ELETE DATA START ===*=== ##

	//MULTIPLE DATA
	public function deleteMultiple($table, $col, $id)
	{
		$sql_code = "DELETE FROM {$table} WHERE {$col} IN ({$id})";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$totalRowSelected = $query->rowCount();

		return $totalRowSelected;
	}


	//BASED ON ID
	public function deleteData($table, $getId)
	{
		$sql_code = "DELETE FROM {$table} WHERE id = {$getId}";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}

	## ===*=== [D]ELETE DATA END ===*=== ##


	## ===*=== [G]ET DATE AND TIME START ===*=== ##

	//DATE ONLY
	public function dateOnly($date)
	{
		$convertString = strtotime($date);
		$convertDate = getDate($convertString);
		$getDate = $convertDate['month'] .' '. $convertDate['mday'] .', '. $convertDate['year'];

		return $getDate;
	}			


	//DATE AND TIME ONLY
	public function dateTime($date)
	{
		$getDateTime = date('M d, Y H:i A', strtotime($date));
		return $getDateTime;
	}	

	## ===*=== [G]ET DATE AND TIME START ===*=== ##


	## ===*=== [G]ET DATE FOR EDIT START ===*=== ##
	
	public function editDate($date)
	{
		$getDate = date('m/d/Y', strtotime($date));
		return $getDate;
	}	

	## ===*=== [G]ET DATE FOR EDIT START ===*=== ##


	## ===*=== [G]ET NAME INDEXS START ===*=== ##

	public function nameIndex($firstName)
	{
		$firstNameSplit = str_split($firstName);
		//$lastNameSplit = str_split($lastName);  . $lastNameSplit[0];
		$getindex = $firstNameSplit[0];

		return $getindex;
	}

	## ===*=== [G]ET NAME INDEXS END ===*=== ##


	## ===*=== [S]UM FUNCTION START ===*=== ##

	public function sumArray($col, $table, $where, $id)
	{
		$sql_code = "SELECT SUM({$col}) AS total FROM {$table} WHERE {$where} = {$id}";

		$query = $this->connection->prepare($sql_code);
		$query->execute();
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();

		if($totalRowSelected > 0) {
			return $dataList;
		} else {
			return 0;
		}
	}

	## ===*=== [S]UM FUNCTION END ===*=== ##


	## ===*=== [D]AY AND TIME COUNT FOR NOTIFICATION START ===*=== ##

	public function time_elapsed_string($datetime, $full = false) 
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);

		foreach ($string as $k => &$v) 
		{
			if ($diff->$k) 
			{
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} 
			else 
			{
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	## ===*=== [D]AY AND TIME COUNT FOR NOTIFICATION END ===*=== ##
}
?>										