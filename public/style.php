<?php 
$color = "#ff0000";
$textColor = "#fff";
$footerPage = "2020 - By Feri Irawan";
?>


<meta name="theme-color" content="<?=$color?>"/>

<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">

<style>
* {
	box-sizing: border-box;
	outline: none;
	font-family: Proxima Nova;
}
html, body {
  padding: 0;
  margin: 0;
}
body::after {
  content: "\00a9  <?=$footerPage?>";
  margin-top: 50px;
  text-align: center;
  font-size: 14px;
  padding: 20px;
  position: absolute;
  display: block;
  left: 0;
  right: 0;
  z-index: 1;
  background: <?=$color?>;
  color: <?=$textColor?>;
}

a {
  text-decoration: none;
}
code {
	background: #ffd0d0;
	color: <?=$color?>;
	padding: 0 5px;
	border-radius: 3px;
	text-shadow: .5px .5px 0px #fff;
  box-shadow: 0 0 0 1.5px #fff;
}

.wrapper {
	max-width: 600px;
}

.title-page, .pesan {
  border-left: 5px solid <?=$color?>;
  padding-left: 10px;
}
.pesan {
	margin: 20px 0;
}
.pesan b {text-transform: capitalize;}
.pre-line {
  white-space: pre-line;
}


table {
  border-collapse: collapse;
  white-space: nowrap;
  text-transform: capitalize;
}
table tr:first-child,
table tr:last-child {
  background: <?=$color?> !important;
  color: <?=$textColor?>;
}
table tr:nth-child(odd) {
  background: rgb(255, 218, 218);
}
table tr:hover {
  background: rgb(255, 180, 180);
}
table tr td,
table tr th {
  padding: 10px;
  border: 1.5px solid rgb(255, 200, 200);
}
table tr td:nth-child(13) {
	background: #00d285;
	color: #fff;
	text-shadow: 1px 1px 0px #00000090;
}

.flex {
	display: flex;
}
.foto-pelanggan {
	overflow: hidden;
	width: 30px;
	height: 30px;
	background: <?=$color?>;
	margin: auto;
	transition: all .3s;
	border-radius: 3px;
}
.foto-pelanggan img {
	width: 100%;
	display: block;
}
.zoomIMG {
	position: fixed;
	top: 0;bottom: 0;
	left: 0;right: 0;
	display: flex;
	margin: auto;
	width: 100%;
	height: 100%;
	transition: all .3s;
	justify-content: center;
}
.zoomIMG .img-wrapper {
	margin: auto;
	position: fixed;
	top: 0;bottom: 0;
	max-width: 600px;
	display: flex;
}
.img-wrapper img {
	width: 100%;
	margin: auto;
	filter: drop-shadow(0px 10px 5px #00000090);
}

.tidak-lengkap .ellipsis {
  position: relative;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  display: block;
  width: 150px;
}
.tidak-lengkap:hover .lengkap {
  display: flex;
}
.tidak-lengkap {
  position: relative;
}
.lengkap {
  justify-content: center;
  align-items: center;
  display: none;
  background: <?=$color?>;
  color: <?=$textColor?>;
  width: 200px;
  padding: 10px;
  border-top: 5px solid #ffbd15;
  border-radius: 5px;
  white-space: normal;
}
.lengkap img {
  width: 100px;
  height: 100px;
  filter: drop-shadow(0px 3px 2px #00000090);
}
.lengkap::after{
  content:"";
  border: 10px solid <?=$color?>;
  border-bottom-color: transparent;
  border-left-color: transparent;
  border-right-color: transparent;
  position: absolute;
  bottom: -19px;
}
.clip-shadow {
  position:absolute;
  bottom: 100%;
  left: -25px;
  z-index: 1;
  filter: drop-shadow(0px 5px 5px #00000090);
}
.clip-shadow.clip-img {
	left: -142%;
}
.overflow-x {
  padding: 20px 0px 0px;
  max-width: 600px;
  overflow-x: scroll;
  transition: all 1s;
}
.btn-sticky {
  position: sticky;
  right: 0;
  background: <?=$color?>;
  color: <?=$textColor?>;
  clip-path: polygon(15% 0%, 100% 0%, 100% 100%, 15% 100%, 0% 50%);
}
.btn-sticky a,
.btn-sticky a i {
  color: <?=$textColor?>;
  padding: 0 0 0 5px;
}
.konfirmasi-hapus {
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	display: flex;
	justify-content: center;
	backdrop-filter: blur(10px);
	animation: opac .3s;
}
.konfirmasi-hapus div {
  background: <?=$color?>;
  padding: 40px 20px 20px;
  margin: auto 20px;
  display: block;
  text-align: center;
  font-size: 14px;
  color: #fff;
  border-radius: 10px;
  box-shadow: 0px 0px 20px 5px #000000b0;
}
.konfirmasi-hapus div .text {
	box-shadow: none;
	padding: 0;
}
.konfirmasi-hapus div .text b {
	background: #fff;
	color: <?=$color?>;
	padding: 0 5px;
	border-radius: 3px;
	margin: 5px;
	text-transform: capitalize;
}
.konfirmasi-hapus div span a {
	display: inline-block;
	background: #fff;
	color: <?=$color?>;
	padding: 8px 10px;
	max-width: max-content;
	margin: 10px 5px;
	border-radius: 5px;
	font-weight: bold;
}

.center {
  text-align: center;
}
.capitalize {
	text-transform: capitalize;
}
.normal-text {
  text-transform: normal;
}
.uppercase {
	text-transform: uppercase !important;
}
.bg-green {
	text-transform: uppercase;
	border-radius: 3px;
	color: #fff;
	background: #00d285;
	font-size: 12px;
	padding: 5px;
	text-shadow: 1px 1px 1px #00000090;
}
.btn {
	padding: 8px 10px;
	border-radius: 5px;
	background: <?=$color?>;
	color: <?=$textColor?>;
	text-align: center;
	max-width: max-content;
	font-size: 14px;
}

/*margin*/
.mr-5px {
	margin-right: 5px;
}
.ml-5px {
	margin-left: 5px !important;
}
.ml-10px {
	margin-left: 10px !important;
}
.mb-5px {
	margin-bottom: 5px;
	display: inline-block;
}

/*padding*/
.p-5px {
	padding: 5px;
}

.sticky-left {
	position: sticky;
	left: 20px;
	max-width: max-content;
}



/*Kusus input*/
form {
  white-space: normal;
  max-width: 300px;
}
.input-group textarea,
input[type="file"],
.input-group input {
  border: 1.5px solid <?= $color ?>;
  padding: 10px;
  border-radius: 3px;
  width: 100%;
  background: #fff;
}
form button {
  width: 100%;
  margin:0 auto;
  padding: 10px;
  display:block;
  background: <?= $color ?>;
  color:#fff;
  border: none;
  border-radius: 10px;
}

/* Show hide Password */
.input-group i.fas,
.input-group i.far,
.input-group i.fal,
.input-group i.fad,
.input-group i.fa-eye,
.input-group i.fa-eye-slash {
  position: absolute;
  right: 14px;
  top: 12px;
  background: #fff;
}

  /* for Float Label on Input */
.input-group {
  position: relative;
  margin: 20px 0 20px;
}
.input-group textarea,
.input-group input {
  font-size: 14px;
  display: block;
  border-radius: 3px;
}

input:focus {
  outline: none;
}

.input-group label {
  color: #999;
  background: #fff;
  font-size: 14px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 13px;
  top: 11px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.input-group textarea:focus ~ label,
.input-group textarea:valid ~ label,
.input-group input:focus ~ label,
.input-group input:valid ~ label {
  top: -10px;
  left: 10px;
  font-size: 12px;
  color: <?= $color ?>;
  border: 1.5px solid <?= $color ?>;
  padding: 0px 3px;
  background: #fff;
  border-radius: 3px;
}
.input-group textarea:valid ~ label,
.input-group input:valid ~ label {
  background: <?= $color ?>;
  color: #fff;
}

input[type="file"] {
  padding: 0 10px;
}
input[type="file"]::-webkit-file-upload-button {
  background: #ffd0d0;
  padding: 10px;
  margin-left: -11px;
  margin-right: 11px;
  font-size: 14px;
  border: none;
  border-radius: 3px 0 0 3px;
}
input[type="file"]:valid {
  color: <?=$color?>;
}
.input-group textarea,
.input-group input {
  text-transform: capitalize;
}

/* checkbox custom */
/* The checkbox-container */
.checkbox-container {
  display: block;
  position: relative;
  margin: 20px 0 0 0;
  padding-left: 20px;
  margin-bottom: 30px;
  max-width: 300px;
  cursor: pointer;
  font-size: 14px;
  /* background: red; */
  color: #444444;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  text-align: left;
}

/* Hide the browsers default checkbox */
.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 1px;
  left: 0px;
  height: 15px;
  width: 15px;
  background-color: #eee;
  border: 1.5px solid <?= $color ?>;
  border-radius: 5px;
  animation: shadow2 1s forwards;
  /* animation-delay: 1s; */
}

/* On mouse-over, add a grey background color */
.checkbox-container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkbox-container input:checked ~ .checkmark {
  background-color: #00d285;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkbox-container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkbox-container .checkmark:after {
  left: 3.5px;
  top: 1px;
  width: 3px;
  height: 5.5px;
  border: solid #fff;
  border-width: 0 2.5px 2.5px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

.center-y {
  margin: 0 auto
}
::-webkit-scrollbar {
	width: 1px;
}
::-webkit-scrollbar-track {
	background: #ffbd15;
}
::-webkit-scrollbar-thumb {
	background: <?=$color?>;
	border-radius: 20px;
}
.full-screen,
i.full-screen {
  position: fixed;
  bottom: 80px;
  right: 20px;
  padding: 13px 14px;
  text-align: center;
  background: <?= $color ?>;
  color: #fff;
  border-radius: 50px;
  border: 3px solid #fff;
  display: none;
}

@media screen and (max-width: 600px) {
	tr#option td.btn-sticky {
		position: static;
	}
	tr#option:hover td.btn-sticky {
		position: sticky;
		animation: opac .7s forwards;
	}
	.overflow-x {
		margin-left: -20px;
		margin-right: -20px;
	}
}
@keyframes opac {
	from {opacity: 0}
	to {opacity: 1}
}
@keyframes opacOut {
	form {opacity: 1}
	to {opacity: 0}
}
@font-face {
  font-family: Proxima Nova;
  src: url(ProximaNova-Regular.otf);
}
</style>