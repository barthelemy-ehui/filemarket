<section class="hero is-primary">
    <div class="hero-body">
        <div class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Total files</div>
                    <div class="title">{{ $fileCount }}</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Total Sales</div>
                    <div class="title">{{ $saleCount }}</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Commission this month</div>
                    <div class="title">{{ number_format($thisMonthCommission, 2) }}€</div>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <div class="heading">Lifetime commission</div>
                    <div class="title">{{ number_format($lifetimeCommission, 2) }}€</div>
                </div>
            </div>
        </div>
    </div>
</section>