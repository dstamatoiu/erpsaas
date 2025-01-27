<?php

namespace App\DTO;

use App\Contracts\MoneyFormattableDTO;

readonly class AgingBucketDTO implements MoneyFormattableDTO
{
    /**
     * @param  array<string, string>  $periods
     */
    public function __construct(
        public string $current,
        public array $periods,
        public string $overPeriods,
        public string $total,
    ) {}

    public static function fromArray(array $balances): static
    {
        $periods = [];

        // Extract all period balances
        foreach ($balances as $key => $value) {
            if (str_starts_with($key, 'period_')) {
                $periods[$key] = $value;
                unset($balances[$key]);
            }
        }

        return new static(
            current: $balances['current'],
            periods: $periods,
            overPeriods: $balances['over_periods'],
            total: $balances['total'],
        );
    }
}
