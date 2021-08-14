<div class="carousel slide" id="loadsp" data-ride="carousel">
    <div class="carousel-inner">
        <?php 
            $a=mysql_query("select * from slides");
            $i = 0;
            while($b=mysql_fetch_array($a))
            {?>
        <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
            <img class="d-block w-100" src="slideshow/images/<?php echo $b["url"]?>" height="220"/> 
        </div>
            <?php $i++; }
        ?> 
    </div>
    <a class="carousel-control-prev" href="#loadsp" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#loadsp" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
