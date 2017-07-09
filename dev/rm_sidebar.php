<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="<?php if($page === 'rm_rulelist.php') echo 'active'; ?>"><a id="rm_rulelist_href" href="rm_rulelist.php?rulesetid=<?php echo $current_ruleset_id;?>"><i class="fa fa-list"></i>&nbsp;Rule List</a></li>
        <li class="<?php if($page === 'rm_ruleeditor.php') echo 'active'; ?>"><a id="rm_ruleeditor_href" href="rm_ruleeditor.php?rulesetid=<?php echo $current_ruleset_id;?>"><i class="fa fa-pencil-square-o"></i>&nbsp;Rule Editor</a></li>
        <li class="<?php if($page === 'rm_rulebranch.php') echo 'active'; ?>"><a  id="rm_rulebranch_href" href="rm_rulebranch.php?rulesetid=<?php echo $current_ruleset_id;?>"><i class="fa fa-tree"></i>&nbsp;Rule Branch</a></li>
        <li class="<?php if($page === 'rm_preference.php') echo 'active'; ?>"><a  id="rm_preference_href" href="rm_preference.php?rulesetid=<?php echo $current_ruleset_id;?>"><i class="fa fa-heart"></i>&nbsp;Preference</a></li>
        <!-- <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Dropdown Item</a></li>
            </ul>
        </li> -->
    </ul>
</div>
<!-- /.navbar-collapse -->
