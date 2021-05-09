
<?php
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'ved');
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="select * from user where 'email=$email' AND password='$password' ";
    $query_run = mysqli_query($connection,$query);
    if(mysqli_fetch_array($query_run)>0)
    {
        echo'<script type=text/javascript"> alert("Logged In) </script>';
      
    }
    else 
    {
        echo'<script type=text/javascript"> alert("Logged In failed) </script>';
    }


}