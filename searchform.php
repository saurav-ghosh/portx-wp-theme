<div class="sidebar__widget sidebar__widget-1 mb-40">
  <div class="sidebar__widget-content">
    <div class="sidebar__search">
      <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="sidebar__search-input-2">
          <input type="search" class="search-field" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
          <button type="submit" class="search-submit"><i class="far fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>