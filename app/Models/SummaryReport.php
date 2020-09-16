<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SummaryReport extends Model
{
    protected $fillable = [
        'id',
        'departure_code',
        'date',
        'time',
        'reservation_code',
        'name',
        'phone',
        'departure_city',
        'departure_point',
        'arrival_city',
        'arrival_point',
        'discount_name',
        'discount_amount',
        'price',
        'seat',
        'status',
        'is_cancel',
        'reservation_by',
        'payment_by',
        'settlement_id'
    ];


    public static function insertOrUpdate(array $rows){
        $table = (new SummaryReport)->getTable();


        $first = reset($rows);

        $columns = implode( ',',
            array_map( function( $value ) { return "$value"; } , array_keys($first) )
        );

        $values = implode( ',', array_map( function( $row ) {
                return '('.implode( ',',
                        array_map( function( $value ) { return '"'.str_replace('"', '""', $value).'"'; } , $row )
                    ).')';
            } , $rows )
        );

        $updates = implode( ',',
            array_map( function( $value ) { return "$value = VALUES($value)"; } , array_keys($first) )
        );

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";

        return \DB::statement( $sql );
    }
}
