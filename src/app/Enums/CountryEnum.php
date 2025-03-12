<?php

namespace App\Enums;

enum CountryEnum: string
{
    case Russia = '+7';
    case USA = '+1';
    case UnitedKingdom = '+44';
    case Germany = '+49';
    case France = '+33';
    case Australia = '+61';
    case India = '+91';
    case China = '+86';
    case Brazil = '+55';

    private static function getCountryByPhone(string $phone): ?self
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        foreach (self::cases() as $country) {
            if (str_starts_with($phone, ltrim($country->value, '+'))) {
                return $country;
            }
        }

        return null;
    }

    public static function getNameCountryByPhone(string $phone): string
    {
        $enum = self::getCountryByPhone($phone);
        return match ($enum) {
            self::Russia => 'Россия',
            self::USA => 'США',
            self::UnitedKingdom => 'Объединенное Королевство',
            self::Germany => 'Германия',
            self::France => 'Франция',
            self::Australia => 'Австралия',
            self::India => 'Индия',
            self::China => 'Китай',
            self::Brazil => 'Бразилия',
            default => 'unknown'
        };
    }

}
