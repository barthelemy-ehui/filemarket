<section class="hero is-primary">
    <div class="hero-body">
        <div class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Files</div>
                    <div class="title">{{ $fileCount }}</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Sales</div>
                    <div class="title">{{ $saleCount }}</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Sales this month</div>
                    <div class="title">{{ $thisMonthEarned }}€</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Lifetime sales</div>
                    <div class="title">{{ $lifetimeEarned }}€</div>
                </div>
            </div>
        </div>
    </div>
</section>