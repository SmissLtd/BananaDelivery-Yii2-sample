<?php

namespace app\helpers;

class DeliveryHelper
{
    public static function buildPacks($count, $sizes)
    {
        $cnt = $count;
        $packs = [];
        if (!empty($sizes)) {
            while ($cnt > 0) {
                $size = self::findBestSize($cnt, $sizes);
                if (!isset($packs[$size->id])) {
                    $packs[$size->id] = ['size' => $size, 'count' => 0];
                }
                $packs[$size->id]['count']++;
                $cnt -= $size->size;
            }
        }
        self::optimizePacks($packs, $count, $sizes);
        return $packs;
    }
    
    private static function findBestSize($count, $sizes)
    {
        // If count is greater or equal to the biggest pack size, then the only choise is to use the biggest pack
        $maxSize = reset($sizes);
        if ($count >= $maxSize->size) {
            return $maxSize;
        }
        
        // Find smallest pack big enough to cover required count
        $best = null;
        foreach ($sizes as $size) {
            if (empty($best)) {
                $best = $size;
                $bestDiff = $size->size - $count;
            } else {
                $diff = abs($size->size - $count);
                if ($diff < $bestDiff) {
                    $best = $size;
                    $bestDiff = $diff;
                }
            }
            if ($size->size <= $count) {
                $best = $size;
                break;
            }
        }
        return $best;
    }
    
    private static function optimizePacks(&$packs, $count, $sizes)
    {
        // Combine small packs into bigger ones
        $found = true;
        while ($found) {
            $found = false;
            foreach ($packs as $id => $pack) {
                if ($pack['count'] > 1) {
                    foreach ($sizes as $size) {
                        if ($size->size < 2 * $pack['size']->size) {
                            break;
                        }
                        if ($size->size == 2 * $pack['size']->size) {
                            if (!isset($packs[$size->id])) {
                                $packs[$size->id] = ['size' => $size, 'count' => 0];
                            }
                            $packs[$size->id]['count']++;
                            $packs[$id]['count'] -= 2;
                            $found = true;
                            break 2;
                        }
                    }
                }
            }
        }
        
        // Remove empty packs
        foreach ($packs as $id => $pack) {
            if ($pack['count'] == 0) {
                unset($packs[$id]);
            }
        }
    }
}