<?php session_start(); ?>
<html>
<head>
	<title><?php echo $book->name;?></title>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" >
	$(function() {
		$(".submit").click(function()
		{
			
			var comment = $("#comment").val();
			var id  = $("#id").val();
			var dataString = 'comment=' + comment+'&id='+id;
			if(comment=='')
			{
				alert('Please Give Valid Details');
			}
			else
			{
				
				$.ajax({
					type: "POST",
					url: "../controllers/commentajax.php",
					data: dataString,
					cache: false,
					success: function(html){
						$("ol#update").prepend(html);
						$("ol#update li:last").fadeIn("slow");
						
					}
				});
			}return false;
		}); });
</script>
</head>
<body>

<div class="row">
				<div class="span10 offset1">            
					<div class="row bottom-space">
						<div class="span3" style="margin-top:20px">
							<ul style="list-style: none;">
								<li id="booktitle" style="font-size:16px"><strong><?php echo $book->name; ?></strong></li>
								<li id="author"><?php echo $book->author; ?></li>
								<li id="category">Category : <?php echo $book->category; ?></li>
								<li id="isbn">ISBN : <?php echo $book->isbn; ?></li>
								<li id="pages">Number of pages : <?php echo $book->pages; ?></li>
								<li id="downloads"> <?php echo "<a href='http://{$book->link}'>"; ?> Click Here to Download</a>	</li>
							</ul>    
						</div>
					</div>
				</div>
			</div>
			<?php ?>
			
<?php //echo $book->name;?> <br>
<?php //echo $book->author;?> <br>
<?php //echo $book->category;?> <br>
<?php //echo $book->isbn;?> <br>
<?php //echo $book->pages;?> <br>
<?php //echo "<a href='http://{$book->link}'>"; ?>


<div >
	<form action="#" method="post">

		<textarea id="comment"></textarea><br />
		<input type="hidden" id="id" value= <?php echo '"'.$id.'"'; ?>  placeholder="">
		<?php if(isset($_SESSION['username'])){ ?><input type="submit" class="submit" value=" Submit Comment " /> <?php }else echo "Login to comment"; ?>
	</form>
</div>
<ol id="update" class="timeline" >
	<?php 
	if($comments)
		foreach ($comments as $row) {
			?> <li class="box">
				<?php echo $row['name']."<br>"; ?>
				<?php echo $row['comment']; ?>
			</li> <?php
		}


	 ?>
</ol>


</body>
</html>