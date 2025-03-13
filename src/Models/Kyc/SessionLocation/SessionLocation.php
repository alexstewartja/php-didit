<?php

namespace AlexStewartJa\Didit\Models\Kyc\SessionLocation;

use AlexStewartJa\Didit\Traits\Arrayable;

class SessionLocation
{
    use Arrayable;

    private ?string $device_brand = null;

    private ?string $device_model = null;

    private ?string $browser_family = null;

    private ?string $os_family = null;

    private ?string $platform = null;

    private ?string $ip_address = null;

    private ?string $ip_country = null;

    private ?string $ip_country_code = null;

    private ?string $ip_state = null;

    private ?string $ip_city = null;

    private ?float $latitude = null;

    private ?float $longitude = null;

    private ?string $isp = null;

    private ?string $organization = null;

    private ?bool $is_vpn_or_tor = null;

    private ?bool $is_data_center = null;

    private ?string $time_zone = null;

    private ?string $time_zone_offset = null;

    private ?string $status = null;

    private ?GeoLocation $document_location = null;

    private ?GeoLocation $ip_location = null;

    private ?GeoDistance $distance_from_document_to_ip_km = null;

    public function getDeviceBrand(): ?string
    {
        return $this->device_brand;
    }

    public function getDeviceModel(): ?string
    {
        return $this->device_model;
    }

    public function getBrowserFamily(): ?string
    {
        return $this->browser_family;
    }

    public function getOsFamily(): ?string
    {
        return $this->os_family;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    public function getIpCountry(): ?string
    {
        return $this->ip_country;
    }

    public function getIpCountryCode(): ?string
    {
        return $this->ip_country_code;
    }

    public function getIpState(): ?string
    {
        return $this->ip_state;
    }

    public function getIpCity(): ?string
    {
        return $this->ip_city;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getIsp(): ?string
    {
        return $this->isp;
    }

    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    public function getIsVpnOrTor(): ?bool
    {
        return $this->is_vpn_or_tor;
    }

    public function getIsDataCenter(): ?bool
    {
        return $this->is_data_center;
    }

    public function getTimeZone(): ?string
    {
        return $this->time_zone;
    }

    public function getTimeZoneOffset(): ?string
    {
        return $this->time_zone_offset;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getDocumentLocation(): ?GeoLocation
    {
        return $this->document_location;
    }

    public function getIpLocation(): ?GeoLocation
    {
        return $this->ip_location;
    }

    public function getDistanceFromDocumentToIpKm(): ?GeoDistance
    {
        return $this->distance_from_document_to_ip_km;
    }
}
