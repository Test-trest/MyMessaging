<?php
    while($userMark = mysql_fetch_assoc($result)):?>        
    <section class="userPrint" onclick="buttonPress(this)">
    <div>
    </div>
    <p>
    <?php echo $userMark['firstname'].' '.$userMark['lastname'] ?>
    </p>
    </section>        		
<?php endwhile?>