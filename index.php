<?php
	/*
		Kitiara See
		Lab 14
		Date: 4/10/18
		Home page for Website that Creates and Manages bank accounts
	*/
		session_start();
		$_SESSION["account"] = array();
?>
<!Doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Kitiara See">
  <title> PYGG Bank</title>
  <link rel="stylesheet" type="text/css" href="css/Bank.css">
</head>


<body>	
	<div id = "wrapper">
		<header>
			<h1>The PYGG Bank</h1>
			<h2> Holding Onto Money Since the 15th Century </h2>
		</header>
		
		<nav>
			<table>
				<tr>
					<th><a href="destroy.php"> Reset Session </a></th>
				</tr>
			</table>
		</nav>
		
		<section>
			<p>
				Welcome to The PYGG Bank online account management. <br>
			</p>
		</section>
<?php
	
	
if (count($_SESSION["account"])== 0)
{
	//First time setup
	newCAccount("Kit See", "44 Foxmoor Circle, 03063", 50);
	newSAccount("Kit See", "44 Foxmoor Circle, 03063", 50);
	newAcc();
}

else if (!isset($_SESSION["account"]))
{
	oldAcc();
	print_r($_SESSION['account']) . "<br>";

}	

else
{
	echo "<p>Something is wrong...</p>";
	session_destroy();
}

	class bAccount
	{
		private $name;
		private $address;
		
		public $number;
		
		function __construct($num, $name, $add)
		{
			$this->number = $num;
			$this->name = $name;
			$this->address = $add;
		}
	}
	
	class Checking extends bAccount
	{
		private $balance;
		
		function __construct($num, $name, $add, $dep)
		{
			parent::__construct($num, $name, $add);
			$this->balance = $dep;
		}
		
		function cAccDeposit($dep)
		{
			if ($dep <= 0)
			{
				echo $dep . " is not a valid value to deposit. Please deposit an amount greater than 0.";
				return;
			}
			else
			{
				$this->balance += $dep;
				echo "Hello $this->name. Thank you for your deposit. Your balance in $this->number is: $this->balance";
				return;
			}
		}
		
		function cAccWithdraw($balance)
		{
			if ($dep <= 0)
			{
				echo $dep . " is not a valid value to deposit. Please deposit an amount greater than 0.";
				return;
			}
			else
			{
				$this->balance -= $dep;
				echo "Hello $this->name. Thank you for your withdrawal. Your balance in $this->number is: $this->balance";
				
				if($this->balance > 0)
				{
					echo "Just a friendly reminder. You have overdrawn your account. Please be aware of the consequences. <br>
						 Your current balance in $this->number is $this->balance";
				}
				
				return;
			}
		}
		
		function displayCBalance($name)
		{
			echo "Hello $name. Your balance is: $this->balance. <br>";
			
			if ($this->balance < 0)
			{
				echo "Just a friendly reminder. You have overdrawn your account. <br>
					 Please bring it back up to a zero or positive balance immediately.";
				return;
			}
			else
			{
				return;
			}
		}
	}
	
	class Savings extends bAccount
	{
		private $balance;
		
		function __construct($num, $name, $add, $dep)
		{
			parent::__construct($num, $name, $add);
			$this->balance = $dep;
		}
		
		function sAccDeposit($balance)
		{
			if ($dep <= 0)
			{
				echo $dep . " is not a valid value to deposit. Please deposit an amount greater than 0.";
				return;
			}
			else
			{
				$this->balance += $dep;
				echo "Hello $this->name. Thank you for your deposit. Your balance in $this->number is: $this->balance";
				return;
			}
		}
		
		function sAccWithdraw($balance)
		{
			if ($dep <= 0)
			{
				echo $dep . " is not a valid value to deposit. Please deposit an amount greater than 0.";
				return;
			}
			else
			{
				$this->balance -= $dep;
				echo "Hello $this->name. Thank you for your withdrawal. Your balance in $this->number is: $this->balance. <br>";
				
				if($this->balance < 0)
				{
					echo "Just a friendly reminder. You have overdrawn your account. Please be aware of the consequences. <br>
						 Your current balance in $this->number is $this->balance. <br>";
						 return;
				}
				else
				{
					return;
				}
			}
		}
		
		function displaySBalance($name)
		{
			echo "Hello $name. Your balance is: $this->balance. <br>";
			
			if ($this->balance < 0)
			{
				echo "Just a friendly reminder. You have overdrawn your account. <br>
					 Please bring it back up to a zero or positive balance immediately.";
				return;
			}
			else
			{
				return;
			}
		}
	}
	
	//creates the new accounts
	function newCAccount($name, $add, $dep)
	{
		$num = 7000 . $name;
		$new = new Checking($num, $name, $add, $dep);
		array_push($_SESSION["account"], $new);
	}
	
	function newSAccount($name, $add, $dep)
	{
		$num = 9000 . $name;
		$new = new Savings($num, $name, $add, $dep);
		array_push($_SESSION["account"], $new);
	}
	
	function newAcc()
	{
		echo "<p>
				In order to open an account with us you will need to register and make a minimum deposit of $50 or more.
			</p>
			
			<table>
			<form method = 'post'>
				<tr>
					<th><label for = 'Name'> Full Name: </label></th>
					 <td><input type = 'text' name = 'Name' id = 'Name' required></td>
				</tr>
				<tr>
					<th><label for = 'add'> Address: <br>(Apt, Street, Zip) </label></th>
					 <td><input type = 'text' name = 'add' id = 'add' required></td>
				</tr>
				<tr>
					<th><label for = 'acctype'> Account Type:</label></th>
					<td>
						<select size='1' name='acctype' id = 'acctype'>
							<option value = 'check'> Checking </option>
							<option value = 'save'> Savings </option>
						</select>
					</td>
				<tr>
					<th><label for = 'dep'> Deposit Amount: </label></th>
					 <td><input type = 'number' name = 'dep' id = 'dep' min = '50' required></td>
				</tr>
				<tr>
					<td> <input type = 'submit' id = 'mySub' name = 'mySub'>
					<input type = 'reset'> </td>
				</tr>
			</form>
			</table>";
			
		//for new accounts
		$type = $_POST["acctype"];
		
		if ($type == "check")
		{
			$name = $_POST["Name"];
			$zip = $_POST["add"];
			$amt = $_POST["dep"];
			
			newCAccount($name, $zip, $amt);
		}
	
		else
		{
			$name = $_POST["Name"];
			$zip = $_POST["add"];
			$amt = $_POST["dep"];
			newSAccount($name, $zip, $amt);
		}
	}

	function oldAcc()
	{
		echo"<form method = 'post'>
				<label for = 'acc'> Account Name </label>
				 <select size='1' name='acc'>";
					for ($i = 0; $i < count($_SESSION["account"]); $i++)
					{
						echo "<option value = '". $_SESSION["account"][$i]->number ."'>". $_SESSION["Account"][$i]->number ."</option>";
					}
			echo"</select>
				<label for = 'doll'> Amount: </label>
				 <input type = 'text' name = 'doll' id = 'doll'>
				<label for = 'update'> Deposit or Withdrawal: </label>
				 <select size='1' name='update'>
					<option value = 'deposit'> Deposit </option>
					<option value = 'withdraw'> Withdrawal </option>
					<option value = 'view'> View Balance </option>
				 </select>
				<input type = 'submit' id = 'mySubmit' name = 'mySubmit'>
			</form>";
			
		$amt = $_POST["doll"];
		$accNum = $_POST["acc"];
		$up = $_POST["update"];
		
		if ($up == "deposit" && ord($accNum) == 55)
		{
			$accNum->cAccDeposit($amt);
		}
		else if ($up == "withdraw" && ord($accNum) == 55)
		{
			$accNum->cAccWithdraw($amt);
		}
		else if ($up == "view" && ord($accNum) == 55)
		{
			$accNum->displayCBalance();
		}
		else if ($up == "deposit" && ord($accNum) == 57)
		{
			$accNum->sAccDeposit($amt);
		}
		else if ($up == "deposit" && ord($accNum) == 57)
		{
			$accNum->sAccWithdraw($amt);
		}
		else
		{
			$accNum->displaySBalance();
		}
	}
	
?>
			<footer class="clear">
				Copyright &copy; 2018 PYGG Bank <br>
				<address> <a href="mailto:PYGGBankCSC@gmail.com">PYGGBankCSC@gmail.com</a></address>
			</footer>
	
		</section>
	</div>
</body>
</html>