<html>
	<head>
		<title>超级管理员界面</title>
		<style>
		body{
			background:url(../images/324182.jpg);
            font-family: "微软雅黑", sans-serif;
            background-size: 100%,100%;
            background-repeat: no-repeat;
		}
		</style>
	</head>
	<body>
		<center>
			<?php 
				
				//1. 导入配置文件
					require("userdbconfig.php");
					
				//2. 连接mysqli、选择数据库
					$link = @mysqli_connect(HOST,USER,PASS) or die("数据库连接失败！");
					mysqli_select_db($link,DBNAME);
					mysqli_set_charset($link,'utf8');
					
				//3. 获取要修改用户信息的账号，并拼装查看sql语句，执行查询，获取要修改的信息
					$sql = "select * from manager where username={$_GET['username']}";
					$result = mysqli_query($link,$sql);
					
				//4. 判断是否获取到了要修改的信息
					if($result && mysqli_num_rows($result)>0){
						$users = mysqli_fetch_assoc($result);
					}else{
						die("没有找到要修改的信息！");
					}
				//5.得到该管理员账号
				$ppusername=$_GET["ppusername"];
			?>
			
			<h3>修改用户信息</h3>
			<form action="user-action.php?action=update&" method="post">
				<input type="hidden" name="pusername" value="<?php echo $users['username']; ?>"/>
				<input type="hidden" name="ppusername" value="<?php echo $ppusername ?>"/>
				<?php echo $ppusername?>
				<table width="420" border="0">
					<tr>
						<td align="right">用户名:</td>
						<td><input type="text" name="username" style="width:200px" value="<?php echo $users['username']; ?>"/></td>
					</tr>
					<tr>
						<td align="right">密码:</td>
						<td><input type="text" name="password" style="width:200px" value="<?php echo $users['password']; ?>"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" value="修改"/>&nbsp;&nbsp;
							<input type="reset" value="重置"/>
						</td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>