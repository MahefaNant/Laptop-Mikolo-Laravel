<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($type)
    {
        parent::__construct();
    }

    /**
     * Create a bar chart.
     *
     * @param array $labels
     * @param array $values
     * @return $this
     */
    public function createBarChart($labels, $values)
    {
        $this->labels($labels)
            ->dataset('Bar Chart', 'bar', $values)
            ->color(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0'])
            ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);

//        $this->configureChart();

        return $this;
    }

    /**
     * Create a line chart.
     *
     * @param array $labels
     * @param array $values
     * @return $this
     */
    public function createLineChart($labels, $values)
    {
        $this->labels($labels)
            ->dataset('Line Chart', 'line', $values)
            ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);

        return $this;
    }

    /**
     * Create a pie chart.
     *
     * @param array $labels
     * @param array $values
     * @return $this
     */
    public function createPieChart($labels, $values)
    {
        $this->labels($labels)
            ->dataset('Pie Chart', 'pie', $values)
            ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);

        return $this;
    }

    /**
     * Create a donut chart.
     *
     * @param array $labels
     * @param array $values
     * @return $this
     */
    public function createDonutChart($labels, $values)
    {
        $this->labels($labels)
            ->dataset('Donut Chart', 'donut', $values)
            ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);

        return $this;
    }

    /**
     * Create a polar area chart.
     *
     * @param array $labels
     * @param array $values
     * @return $this
     */
    public function createPolarAreaChart($labels, $values)
    {
        $this->labels($labels)
            ->dataset('Polar Area Chart', 'polarArea', $values)
            ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);

        return $this;
    }

    /**
     * Create a radar chart.
     *
     * @param array $labels
     * @param array $datasets
     * @return $this
     */
    public function createRadarChart($labels, $datasets)
    {
        $this->labels($labels);

        foreach ($datasets as $dataset) {
            $this->dataset($dataset['label'], 'radar', $dataset['data'])
                ->backgroundcolor(['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']);
        }

        return $this;
    }

}
