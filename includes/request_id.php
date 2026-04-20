<?php
/**
 * DATAVANT Systems - Request ID generator.
 * Emits RFC 4122 version-4 UUIDs. Used to correlate client responses
 * with server-side audit log entries without exposing PII.
 */

if (!function_exists('request_id_new')) {
    /**
     * Generate a UUIDv4 string.
     *
     * @return string
     */
    function request_id_new() {
        $bytes = random_bytes(16);
        // Set version (0100) and variant (10xx) bits per RFC 4122.
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $hex = bin2hex($bytes);
        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12)
        );
    }
}
