<?php
include '../includes/db.php';
?>
<?php
   

   if(isset($_POST['create_post'])) {

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
   
            $post_title        = mysqli_escape_string($connection, $_POST['title']);
            $post_name = str_replace(' ', '-', $post_title);
    
            $post_image        =mysqli_escape_string($connection, $_FILES['image']['name']);
            $post_image_temp   = mysqli_escape_string($connection, $_FILES['image']['tmp_name']);
    
    
            $post_content      = mysqli_escape_string($connection, $_POST['post_content']);
            $post_date         = mysqli_escape_string($connection, date('d-m-y'));

       
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // move_uploaded_file($post_image_temp, "../uploads/$post_image" );
       
       
      $query = "INSERT INTO posts (post_title, post_name, post_date, post_image, post_content) VALUES('$post_title', '$post_name', '$post_date', '$post_image', '$post_content')"; 
             
      $create_post_query = mysqli_query($connection, $query);  
          
    //   confirmQuery($create_post_query);

    //   $the_post_id = mysqli_insert_id($connection);


    //   echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";
       if($create_post_query){
           echo 'success';
       }else{
        die("QUERY FAILED" . mysqli_error($connection));
       }


   }
    

    
    
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>


      <!-- <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="author">
      </div> -->
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    