<?php $all_terms = $args['itineris_query'];?>
<div class="main-filter">
    <div class="campus-filter">
        <div class="filter-top">
            <span>Filter by campus</span>
        </div>
        <div class="filter-content">
            <ul>
                <?php foreach ($all_terms['campus'] as $campus):?>
                    <li>
                        <input type="checkbox" id="campus-<?php echo $campus->term_id ?>">
                        <label for="campus-<?php echo $campus->term_id ?>"><?php echo $campus->name ?></label>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>

    </div>
    <div class="type-filter">
        <div class="filter-top">
            <span>Filter by course type</span>
        </div>
        <div class="filter-content">
            <ul>
                <?php foreach ($all_terms['type'] as $type):?>
                    <li>
                        <input type="checkbox" id="campus-<?php echo $type->term_id ?>">
                        <label for="campus-<?php echo $type->term_id ?>"><?php echo $type->name ?></label></li>
                <?php endforeach;?>
            </ul>
        </div>
        
    </div>
    <input type="submit" value="Apply now">
</div>
