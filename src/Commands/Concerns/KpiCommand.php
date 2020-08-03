<?php

namespace SevenLab\Kpi\Commands\Concerns;

interface KpiCommand {
    public function gatherStats();
    public function handle();
}
