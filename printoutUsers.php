<?php
    while($userMark = mysql_fetch_assoc($resultUsers)):?>
    <section class="userPrint" onclick="buttonPress(this,<?php echo $userMark['id'] ?>,<?php echo $user['id'] ?>)">
    <div>
    </div>   
    <a href="user_profile.php?id"><p>
    <?php echo $userMark['username'] ?>
    </p></a>
    </section>    
    
<?php endwhile?>