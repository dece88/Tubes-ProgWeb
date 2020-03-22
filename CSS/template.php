@font-face{
	font-family: "exo2";
	src: url("Font/Exo2.otf");	
}

body{
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
	font-family: exo2;
	padding:0;
	margin:0;
}

.logo{
	height : 60px;
	width: 60px;
	padding : 5;
}

.icon{
	height : 60px;
	width: 60px;
	padding : 5;
	opacity: 10%;
}
.open-slide a{
	float: right;
	padding: 20px;
}

.navbar{
	background-color: rgba(0,0,0,0.8);
	height: 65px;
}

.side-nav{
	height: 100%;
	width: 0;
	position: fixed;
	z-index:1;
	top:0;
	right:0;
	float:right;
	background-color: black;
	opacity: 0.9;
	overflow-x:hidden;
	padding-top: 60px;
	transition: 0.5s;
}

.side-nav .btn-close{
	position: absolute;
	width: 20%;
	top: 0;
	font-size: 36px;
	padding-left:9%;
}

.side-nav a{
	padding: 10px 10px 10px 30px;
	text-decoration: none;
	font-size: 22px;
	color: white;
	display: block;
	transition: 0.3s;
}
.side-nav .profile a{
	padding: 10px 15px 10px 10px;
	text-decoration: none;
	font-size: 20px;
	color: white;
	margin-bottom: 10px
}
.side-nav .profile .sign{
	background-color:white;
	color:black;
	padding: 10px 7px 10px 7px;
	margin-left : 5px;	
	margin-right:5px;
	text-decoration: none;
	border-radius: 2px;
}

.side-nav .profile .sign:hover{
	background-color:white;
	text-decoration: none;
	
}

.side-nav .profile a:hover{
	text-decoration: underline;
	background-color: black;
	opacity: 0.9;
}

.side-nav .profile{
	display: block;
	transition: 03s;
}

.side-nav .profile-pict{
	margin-left: 10px;
	height: 120px;	
	width: 120px;
	border-radius: 60px;
	margin-right: 10px;
}

.side-nav a:hover{
	background-color: grey;
}


#main{
	background-color: white;
	width: 80%;
	overflow: hidden;
	text-align: center;
	margin: auto;
	font-family: exo2;
}

#main .style{
	text-align: center;
	display: block;
}

.footer{
	background-image:linear-gradient(rgba(1,1,1,0.75), rgba(1, 1, 1, 0.75));
	background-position: center;
	color: grey;
	padding: 5px;
	height: 30%;
	margin: 0;
}
