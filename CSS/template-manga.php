	@font-face{
		font-family: "exo2";
		src: url("../CSS/Font/Exo2.otf");	
	}
	.manga_list{
		margin: 5px;
		display: inline-block;
		width: 150px;
		height: 300px;
	}
	
	.manga_drop{
		display: none;
		position: absolute;
		background-color: black;
		width: 460px;
		height: 270px;
		z-index:1;
		padding-top: 7px;
		padding-left: 15px;
		padding-right: 15px;
	}
	
	.title_drop{
		color: white;
		font-family: exo2;
		font-size: 18;
	}	
	
	.manga_drop .manga_drop_info{
		z-index:1;
		margin-top: 10px;
		margin-left: 162px;
		font-family: exo2;
		color: white;
		font-size: 15;
		text-align: justify;
	}
	
	.manga_cover:hover .manga_drop{
		display:block;
	}

	.cover{
		width: 150px;
		height: 200px;
	}
	
	.title{
		margin-top:10px;
		font-family: exo2;
		margin-left: 7px;
		width: 140px;
		height: 20px;
		font-size: 17;
	}
	
	.title a{
		text-decoration: none;
		color: black;
	}
	.chapter{
		margin-top:24px;
		margin-left: 7px;
		font-size: 15;
	}
	.chapter a{
		text-decoration:none;
		font-family: exo2;
		color: grey;
	}