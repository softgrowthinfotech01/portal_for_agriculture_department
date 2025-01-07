<div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
                <!--<input type="text" id="search" placeholder="Search Here..." />-->
                <select class="form-control" onchange="get_blog_yearwise(this.value)">
                    <option value="">Select By Year</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
                <!--<button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>-->
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
<script>
    function get_blog_yearwise(yr)
    {
        window.location.href = "yearwiseblog?y="+yr;
    }
</script>