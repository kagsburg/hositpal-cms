<!DOCTYPE html>
<html>
	<head>
		<title>hide scrollbar</title>
		<style>
	html,
body {
  width: 100%;
  height: 100%;
}

body {
  
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
.card {
  
  min-width: 100%;
  
display: flex;
overflow-x: auto;
}
.card--content {  
  width: 150px;
  margin: 5px;
}
.card--content  img{width: 150px;}
.card::-webkit-scrollbar {
  display: none;
}
		</style>
	</head>
	<body>
	<section class="card">
            <div class="card--content">
                <img src="images/avatar/1.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/2.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/3.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/4.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/5.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/5.png">
            </div>
             <div class="card--content">
                <img src="images/avatar/6.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/7.jpg">
            </div>
             <div class="card--content">
                <img src="images/avatar/8.jpg">
            </div>
  
</section>
	</body>
</html>					
