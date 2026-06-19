<div class="Product-Category">
    <h1 class="Category-Title"><?php echo esc_html($data['category']['name']); ?></h1>
    <p class="Category-Title__Text"><?php echo esc_html($data['category']['description']); ?></p>
    <div class="grid grid--three">
        
        <?php foreach ($data['posts'] as $post): ?>
            <a class="ProductCard" href="<?php echo esc_url($post['link']); ?>">
                <img class="ProductCard-Image" src="<?php echo esc_url($post['thumbnail']); ?>">
                <div class="ProductCard-Tilte">
                <h3 class="ProductCard-Content"><?= esc_html($post['title']) ?></h3>
                <p class="ProductCard-Text"><?php echo esc_html($post['excerpt']); ?></p>
                </div>
            </a> 
        <?php endforeach; ?>
    </div>

    <?php
    // ===== Phân trang =====
    $pg  = isset($data['pagination']) ? $data['pagination'] : ['current' => 1, 'total' => 1];
    $cur = max(1, (int) ($pg['current'] ?? 1));
    $tot = max(1, (int) ($pg['total'] ?? 1));
    if ($tot > 1):
        $base = trailingslashit($data['category']['link']);
        $page_url = function ($n) use ($base) {
            $n = (int) $n;
            return $n <= 1 ? $base : $base . 'page/' . $n . '/';
        };
        // Danh sách số trang, rút gọn bằng "…" khi nhiều trang.
        $items = [];
        if ($tot <= 7) {
            for ($i = 1; $i <= $tot; $i++) $items[] = $i;
        } else {
            $items[] = 1;
            if ($cur > 3) $items[] = '...';
            for ($i = max(2, $cur - 1); $i <= min($tot - 1, $cur + 1); $i++) $items[] = $i;
            if ($cur < $tot - 2) $items[] = '...';
            $items[] = $tot;
        }
    ?>
    <nav class="dt-pagination" aria-label="Phân trang bài viết">
        <?php if ($cur > 1): ?>
            <a class="dt-pagination__item dt-pagination__nav" href="<?php echo esc_url($page_url($cur - 1)); ?>" rel="prev" aria-label="Trang trước">‹</a>
        <?php endif; ?>

        <?php foreach ($items as $it): ?>
            <?php if ($it === '...'): ?>
                <span class="dt-pagination__dots">…</span>
            <?php elseif ((int) $it === $cur): ?>
                <span class="dt-pagination__item is-current" aria-current="page"><?php echo (int) $it; ?></span>
            <?php else: ?>
                <a class="dt-pagination__item" href="<?php echo esc_url($page_url($it)); ?>"><?php echo (int) $it; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($cur < $tot): ?>
            <a class="dt-pagination__item dt-pagination__nav" href="<?php echo esc_url($page_url($cur + 1)); ?>" rel="next" aria-label="Trang sau">›</a>
        <?php endif; ?>
    </nav>
    <?php endif; ?>
</div>

