<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Displays the current routes for an application.
 *
 * @package    symfony
 * @subpackage task
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfAppRoutesTask.class.php 23549 2009-11-03 09:10:12Z fabien $
 */
class aggreg8PagesTask extends sfBaseTask {
    protected
    $routes = array();

    /**
     * @see sfTask
     */
    protected function configure() {
        $this->addArguments(array(
            new sfCommandArgument('event_code', sfCommandArgument::OPTIONAL, 'The event code'),
        ));

        $this->namespace = 'aggreg8';
        $this->name = 'pages';
        $this->briefDescription = 'Finds all the pages on JustGiving and aggreg8s them.';

        $this->detailedDescription = <<<EOF
The [aggreg8:pages|INFO] finds all the pages on JustGiving and aggreg8s them.

If the event code is specified, it will only find the pages under that event.

  [./symfony aggreg8:pages event_code|INFO]
EOF;
    }

    /**
     * @see sfTask
     */
    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);

        // display
        $eventCode = $arguments['event_code'];

        if ($eventCode != null) {

            $event = Doctrine_Core::getTable('Event')->findOneByCode($eventCode);

            $total = 0;
            //get the event and look through all its pages.
            foreach ($event->JustGivingEvent as $jgEvent)
            {
                $pages = Doctrine_Core::getTable('Page')->findByJustGivingEventId($jgEvent->id);

                //get and save the amount raised for each page.
                foreach ($pages as $page)
                {
                    $resp = JustGivingAPI::retrievePage($page->short_name);

                    $moneyRaised = (string) $resp->grandTotalRaisedExcludingGiftAid;
                    $page->money_raised = $moneyRaised;
                    $page->save();

                    if ($moneyRaised > 0) {
                        $total += $moneyRaised;
                    }

                }
            }

            //save the events total.
            $event->total_money = $total;
            $event->save();
        }

    }

}
