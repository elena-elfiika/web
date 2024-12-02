<?php
                // Часовой пояс
                date_default_timezone_set("Europe/Moscow");
                //Дата
                $date = new DateTime();
                //Форматирование
                $intlFormatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                $intlFormatter->setPattern('MMMM YYYY');
                $weekform = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
                $weekform->setPattern('EEEE');
                $year =  date('Y');
                $vis = date("L", mktime(0,0,0, 7,7, $year));
                $timestamp = strtotime('02.09.2024 00:00');
                $week = date('W') - date('W', $timestamp) + 1;
                if ($week % 2 != 0){
                    $wch = 'нечетная';
                } else {
                    $wch = 'четная';
                }
                $day = date('d');
                $nFormat = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
                $nFormat->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal-neuter");
                $nFormat_2 = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
                $nFormat_2->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal-feminine");
                if ($vis == 1){
                    echo '<p class="header_time">'.'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('високосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'.   '.'На часах '.date('H:i').'</p>';
                } else {
                    echo '<p class="header_time">'.'Сегодня '.$nFormat->format($day).' '.$intlFormatter->format($date).' ('.('невисокосный год').')'.', '.$weekform->format($date).', '.$nFormat_2->format($week).(' неделя, ').($wch).'.   '.'На часах '.date('H:i').'</p>';
                }
                ?>