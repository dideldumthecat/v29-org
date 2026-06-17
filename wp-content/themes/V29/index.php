<!doctype html>
<html lang="de">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
        <meta name="theme-color" content="#000000" />
        <meta name="description" content="V29 ist ein sozial-ökologisches Kollektivbauprojekt" />
        <meta name="robots" content="index, follow" />
        <meta name="format-detection" content="telephone=no" />
        <link rel="canonical" href="https://v29.org/" />
        <meta property="og:title" content="V29 ist ein sozial-ökologisches Kollektivbauprojekt" />
        <meta property="og:description" content="V29 ist ein sozial-ökologisches Kollektivbauprojekt" />
        <meta property="og:image" content="https://v29.org/media/og.webp" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://v29.org" />
        <meta property="og:site_name" content="V29" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <title>V29</title>
        <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
        <link rel="shortcut icon" href="favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="V29" />
        <link rel="manifest" href="favicon/site.webmanifest" />
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <h1 class="sr-only">V29 ist ein sozial-ökologisches Kollektivbauprojekt</h1>
        <div class="timeline-bg">
            <img id="bg-a" class="no-lazy">
            <img id="bg-b" class="no-lazy">
        </div>

        <section class="section top">
            <img class="title-video" id="title-webp-sequence" />

            <div class="timeline-controls">
                <button id="timeline-start">Start</button>
                <button id="timeline-today">Heute</button>
                <button id="timeline-zoom">Zoom</button>
                <button id="timeline-end">Info</button>
            </div>
        </section>
        <div class="today-line"></div>

        <section class="timeline-section">
            <div class="timeline-container">
                <div class="timeline">
                    <!-- ===== Jahre ===== -->
                    <div class="cell header"></div>
                    <!-- Ecke links oben -->
                    <div class="cell year" style="grid-column: 2 / span 1">2025</div>
                    <div class="cell year" style="grid-column: 13 / span 1">2026</div>
                    <div class="cell year year-col" style="grid-column: 25 / span 1">2027</div>
                    <div class="cell year year-col" style="grid-column: 26 / span 1">2028</div>
                    <div class="cell year year-col" style="grid-column: 27 / span 1">2029</div>
                    <div class="cell year year-col" style="grid-column: 28 / span 1">2030</div>
                    <div class="cell info-cell" style="grid-column: 29 / span 1; grid-row: 3 / -1">
                        <p>
                            DE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Das Vorhaben der Gruppe V29 verbindet
                            gemeinwohlorientierten Wohnungsbau mit einer experimentell-forschenden Baupraxis. In einer
                            Baulücke in Leipzig soll ein Wohngebäude entstehen. Es wird als eines der ersten Projekte
                            einer sich derzeit in Gründung befindlichen Dachgenossenschaft realisiert. Initiiert wurde
                            das Projekt von neun Architekt*innen, die in Praxis und Lehre zu ressourcenschonenden
                            Bauweisen arbeiten. Das Gebäude ist nicht zur Eigennutzung vorgesehen, sondern soll als
                            geförderter Wohnraum für vulnerable Gruppen errichtet werden. Damit versteht sich das
                            Projekt als Reallabor für ökologisches, partizipatives und gemeinwohlorientiertes Bauen
                            unter realen Bedingungen.
                            <br /><br />
                            EN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V29 combines public welfare-oriented housing
                            construction with experimental, research-based building practices. A residential building is
                            planned on a vacant lot in Leipzig and will be among the first projects realized by an
                            umbrella cooperative currently in the process of being established. The initiative was
                            launched by nine architects who work in both practice and teaching on resource-efficient
                            construction methods. The building is not intended for personal use but will provide
                            subsidized housing for vulnerable groups. The project therefore understands itself as a
                            real-world laboratory for ecological, participatory, and public-interest-oriented
                            construction under practical conditions.
                            <br /><br />
                            <a href="mailto:mail@v29.org">Kontakt</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" id="impressum-link">Impressum</a>
                        </p>
                    </div>

                    <!-- ===== Monate ===== -->

                    <div class="cell header"></div>
                    <div class="cell header"></div>

                    <div class="cell header">Feb</div>
                    <div class="cell header">Mär</div>
                    <div class="cell header">Apr</div>
                    <div class="cell header">Mai</div>
                    <div class="cell header">Jun</div>
                    <div class="cell header">Jul</div>
                    <div class="cell header">Aug</div>
                    <div class="cell header">Sep</div>
                    <div class="cell header">Okt</div>
                    <div class="cell header">Nov</div>
                    <div class="cell header">Dez</div>

                    <div class="cell header">Jän</div>
                    <div class="cell header">Feb</div>
                    <div class="cell header">Mär</div>
                    <div class="cell header">Apr</div>
                    <div class="cell header">Mai</div>
                    <div class="cell header">Jun</div>
                    <div class="cell header">Jul</div>
                    <div class="cell header">Aug</div>
                    <div class="cell header">Sep</div>
                    <div class="cell header">Okt</div>
                    <div class="cell header">Nov</div>
                    <div class="cell header">Dez</div>

                    <div class="cell header"></div>
                    <div class="cell header"></div>
                    <div class="cell header"></div>
                    <div class="cell header"></div>

                    <div class="cell header"></div>

                    <!-- ===== Planung ===== -->

                    <div class="cell row-title">Struktur</div>

                    <div class="cell event" style="grid-column: span 9">
                        24.2. Kauf des Grundstücks Volbedingstraße 29, 04357 Leipzig
                    </div>
                    <div class="cell event" style="grid-column: span 3">
                        5.11. Anmietung Lagerfläche am Lindenauer Hafen, Leipzig
                    </div>

                    <div class="cell event" style="grid-column: span 2">24.2. Gründungsevent Dachgenossenschaft</div>

                    <div class="cell event" style="grid-column: span 6">
                        1.4.–30.6. anvisierte Übertragung der Liegenschaft V29 an eine Dachgenossenschaft
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell active">Einzug</div>

                    <!-- ===== Materialfluss ===== -->
                    <div class="cell row-title">Am Bau</div>

                    <div class="cell"></div>
                    <div class="cell media-cell" style="grid-column: span 2">
                        <video
                            class="thumbnail"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/250301_a.mp4","caption":"1.3.2025: Auf dieser Baulücke im Leipziger Norden wollen wir neuen genossenschaftlichen Wohnraum schaffen."},
    {"type":"image","src":"media/250301_b.webp","caption":"1.3.2025: Der Wohnraum soll günstig und nicht-profitorientiert angeboten werden."},
    {"type":"image","src":"media/250301_c.webp","caption":"1.3.2025: V29 bei der Säuberung des Grundstücks."},
    {"type":"image","src":"media/250301_d.webp","caption":"1.3.2025: Auf dieser Baulücke stand bereits einmal ein Haus."},
    {"type":"video","src":"media/250301_e.mp4","caption":"1.3.2025: Wir beginnen mit der Suche nach eventuell noch nutzbaren Bestandsfundamenten."},
    {"type":"image","src":"media/250301_f.webp","caption":"1.3.2025: Alles Vorhandene soll wann immer möglich weiter genutzt werden."}
        ]'>
                            <source src="media/250301_a.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            src="media/260112_a.webp"
                            class="thumbnail"
                            alt="12.01.2026"
                            data-media='[
    {"type":"image","src":"media/260112_a.webp","caption":"12.1.2026: Das Projekt V29 untersucht das Potential von \"Schwachholz\" im Wohnungsbau."},
    {"type":"video","src":"media/260112_b.mp4","caption":"12.1.2026: Austausch mit dem Staatsbetrieb Sachsenforst, Forstbezirk Taura, Revier 01 Reudnitz"},
    {"type":"image","src":"media/260112_c.webp","caption":"12.1.2026: \"Schwache\" Stämme mit geringem Durchmesser fallen regelmäßig bei Durchforstungen an."},
    {"type":"video","src":"media/260118_d.mp4","caption":"18.1.2026: Schwachholz von Buche, Erle, Eiche oder Birke wird aktuell fast gar nicht als konstruktives Vollholz benutzt."},
    {"type":"image","src":"media/260118_e.webp","caption":"18.1.2026: Die Stammdurchmesser der Laubhölzer sind zu klein und die Geometrien zu krumm."},
    {"type":"video","src":"media/260118_f.mp4","caption":"18.1.2026: Als \"Industrieholz\" wird es meist mechanisch zerkleinert und zu Span- oder Faserplatten verarbeitet."},
    {"type":"video","src":"media/260118_g.mp4","caption":"18.1.2026: Laubholz gewinnt jedoch im ökologischen Waldumbau immer mehr an Bedeutung."},
    {"type":"video","src":"media/260118_h.mp4","caption":"18.1.2026: Das V29-Projekt erforscht das Potential von Laubschwachhölzern im Wohnungsbau"}
        ]' />
                    </div>
                    <div class="cell media-cell" style="grid-column: span 2">
                        <video
                            class="thumbnail"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/260130_a.mp4","caption":"30.1.2026: Mit einer Blochbandsäge testen wir das Potential abholziger oder mehrfach gekrümmter Laubholzstämme"},
    {"type":"video","src":"media/260130_b.mp4","caption":"30.1.2026: Die Stämme werden dazu \"sägegestreift\"."},
    {"type":"video","src":"media/260130_c.mp4","caption":"30.1.2026: Ziel ist das vierseitige Herstellen flächiger Kanten. "},
    {"type":"video","src":"media/260130_d.mp4","caption":"30.1.2026: Es wird so wenig wie möglich von den Stämmen abgeschnitten."},
    {"type":"video","src":"media/260130_e.mp4","caption":"30.1.2026: Um möglichst viel von dem Stammquerschnitt nutzen."},
    {"type":"image","src":"media/260130_f.webp","caption":"30.1.2026: Ziel ist der Verzicht auf technische Trocknung, Verleimung und Hobeln"}
        ]'>
                            <source src="media/260130_a.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <div class="cell media-cell" style="grid-column: span 2">
                        <video
                            class="thumbnail"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/260304_a.mp4","caption":"4.3.2026: Die Fundamente und Brandwände werden aus gebrauchten Ziegeln errichtet."},
    {"type":"video","src":"media/260304_b.mp4","caption":"4.3.2026: Diese bauen wir aktuell aus einer verfallenen Scheune in Lützen zurück."},
    {"type":"video","src":"media/260304_c.mp4","caption":"1.3.2026: Wir benötigen rund 50.000 Steine, d.h. 100 Paletten."},
    {"type":"video","src":"media/260304_d.mp4","caption":"1.3.2026: Die mit weichem Kalkmörtel vermauerten Steine lassen sich sehr einfach säubern"},
    {"type":"video","src":"media/260304_e.mp4","caption":"4.3.2026: Dennoch bleibt noch viel Arbeit bis alle benötigten Steine geborgen sind."}
        ]'>
                            <source src="media/260304_a.mp4" type="video/mp4" />
                        </video>
                    </div>

                    <div class="cell"></div>

                    <div class="cell active" style="grid-column: span 2">
                        Geplanter Rückbau wiederverwendete Betonteile
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <!-- ===== Events ===== -->
                    <div class="cell row-title">Events</div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            src="media/250704_a.webp"
                            class="thumbnail"
                            alt="4.7.2025"
                            data-media='[
    {"type":"image","src":"media/250704_a.webp","caption":"4.7.2025: Die Gruppe V29 ist eine Initiative von aktuell neun Architekt*innen aus Praxis und Lehre, die sich interdisziplinär kontinuierlich erweitert."},
    {"type":"video","src":"media/250704_b.mp4","caption":"4.7.2025: Bei diesem Treffen wurden erste Ideen für ein genossenschaftliches Wohnungsbauprojekt auf der Parzelle gesammelt."},
    {"type":"video","src":"media/250704_c.mp4","caption":"4.7.2025: Das Projekt ist kein privates Baugruppenprojekt, sondern wird einen Beitrag zur sozialen Wohnraumschaffung für vulnerable Gruppen leisten."},
    {"type":"image","src":"media/250704_d.webp","caption":"4.7.2025: Auf dieser Parzelle im Leipziger Norden wird der sozial-ökologisches Experimentalbau entstehen."}
        ]' />
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell media-cell" style="grid-column: span 1">
                        <video
                            class="thumbnail"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/260307_a.mp4","caption":"7.3.2026: Bau eines ersten Mock-Ups aus Schwachholz für die Ausstellung Algen | Schutt | CO2 im Bauhaus Dessau."},
    {"type":"image","src":"media/260307_b.webp","caption":"7.3.2026: Nebeneinander liegend verbinden sich die Stämme zu einer Geschossdecke, angelehnt an historische \"Dippelbaumdecken\"."},
    {"type":"image","src":"media/260307_c.webp","caption":"7.3.2026: Schwachholz-Stiele bilden das Grundgerüst der tragenden Wände"},
    {"type":"video","src":"media/260307_d.mp4","caption":"7.3.2026: Als Füllung zwischen den Wandstielen kommt \"Strohlehm\" zum Einsatz."},
    {"type":"image","src":"media/260307_e.webp","caption":"7.3.2026: Der Strohlehm übernimmt Funktionen des Schall-, Feuchtigkeit- und Brandschutzes."},
    {"type":"video","src":"media/260307_f.mp4","caption":"12.3.2026: Im März 2026 haben wir das Mock-up ins ehemalige Kaufhaus Zeeck transportiert."},
    {"type":"video","src":"media/260307_g.mp4","caption":"14.3.2026: Wir möchten die Ausstellungszeit nutzen, um weiter am Mock-up zu arbeiten."},
    {"type":"video","src":"media/260307_h.mp4","caption":"14.3.2026: Wissen wird dabei im praktischen Tun generiert."},
    {"type":"video","src":"media/260307_i.mp4","caption":"14.3.2026: Das Mock-up ist damit mehr Hypothese als definitive Antwort."},
    {"type":"video","src":"media/260307_j.mp4","caption":"18.3.2026: Das Mock up wird sich während der Ausstellungszeit verändern und neue Erkenntnisse und Wissensstände sichtbar machen."}
        ]'>
                            <source src="media/260307_a.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <a
                        href="https://bauhaus-dessau.de/en/exhibitions/algae-debris-co2/"
                        target="_blank"
                        class="cell active"
                        style="grid-column: span 6">
                        28.3-27.9. Bauhaus Dessau: Algen | Schutt | CO2, Ehemaliges Kaufhaus Zeeck.<br />23.05., 13:00
                        Workshop V29, Ehemaliges Kaufhaus Zeeck
                    </a>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <!-- ===== Vorstellung ===== -->
                    <div class="cell row-title">Am Tisch</div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            class="thumbnail white-image"
                            src="media/250227_a.webp"
                            alt="7.2.2025: Skizze"
                            data-media='[
    {"type":"image","src":"media/250227_a.webp","caption":"27.2.2025: Skizze","white":true}
        ]' />
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <video
                            class="thumbnail white-image"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/250523_a.mp4","caption":"23.5.2025: Skizzen","white":true},
    {"type":"image","src":"media/250523_b.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_c.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_d.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_e.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_f.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_g.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_h.webp","caption":"","white":true},
    {"type":"image","src":"media/250523_i.webp","caption":"","white":true}
        ]'>
                            <source src="media/250523_a.mp4" type="video/mp4" />
                        </video>
                    </div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            class="thumbnail"
                            src="media/250606_a.webp"
                            alt="6.6.2025"
                            data-media='[
    {"type":"image","src":"media/250606_a.webp","caption":"6.6.2025: Wieviele Baumstämme braucht man für ein Wohnhaus?"},
    {"type":"image","src":"media/250606_b.webp","caption":"6.6.2025: Erste Modellskizzen für ein Wohngebäude aus Rundholz"},
    {"type":"image","src":"media/250606_c.webp","caption":"6.6.2025: Schwachverarbeitetes Stammholz findet beim Bauen bisher wenig Beachtung"},
    {"type":"image","src":"media/250606_d.webp","caption":"6.6.2025: Kann aus solchem Holz ein Wohngebäude entstehen?"},
    {"type":"image","src":"media/250606_e.webp","caption":"6.6.2025: Das Projekt untersucht das Potential von \"Durchforstungsholz\" beim Bauen"},
    {"type":"image","src":"media/250606_f.webp","caption":"6.6.2025: \"Durchforstungsholz\" sind schwache (Laub-)Holzstämme, die regelmäßig im Wald entnommen werden"}
        ]' />
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            class="thumbnail white-image"
                            src="media/251022_a.webp"
                            alt="22.10.2025"
                            data-media='[
    {"type":"image","src":"media/251022_a.webp","caption":"22.10.2025: Grundriss Erdgeschoss","white":true},
    {"type":"image","src":"media/251022_b.webp","caption":"22.10.2025: Grundriss 1. Obergeschoss","white":true},
    {"type":"image","src":"media/251022_c.webp","caption":"22.10.2025: Grundriss 2. Obergeschoss","white":true},
    {"type":"image","src":"media/251022_d.webp","caption":"22.10.2025: Ansicht Nord","white":true},
    {"type":"image","src":"media/251022_e.webp","caption":"22.10.2025: Ansicht Süd","white":true},
    {"type":"image","src":"media/251022_f.webp","caption":"22.10.2025: Schnitt AA","white":true}
        ]' />
                    </div>
                    <div class="cell media-cell" style="grid-column: span 1">
                        <video
                            class="thumbnail"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"image","src":"media/251221_stuetzenknoten_1c.webp","caption":"21.11.2025: Stützenknoten auf wiederverwendetem Betonsockel"},
    {"type":"image","src":"media/251221_stuetzenknoten_4b.webp","caption":""},
    {"type":"image","src":"media/251221_stuetzenknoten_6d.webp","caption":""},
    {"type":"image","src":"media/251221_stuetzenknoten_7.webp","caption":""},
    {"type":"image","src":"media/260102_statik.webp","caption":"","white":true}
        ]'>
                            <source src="media/251221_stuetzenknoten.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <div class="cell"></div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <video
                            class="thumbnail white-image"
                            muted
                            autoplay
                            loop
                            playsinline
                            preload="auto"
                            data-media='[
    {"type":"video","src":"media/260129_a.mp4","caption":"29.1.2026: Vorbemessung Schwergewichtswand Gründung aus wiederverwendeten Betonelementen bzw. Ziegeln","white":true},
    {"type":"video","src":"media/260129_c.mp4","caption":"29.1.2026: Gründungsszenarien auf Basis wiederverwendeter Betonelemente 3D","white":true},
    {"type":"video","src":"media/260129_d.mp4","caption":"29.1.2026: Gründungsszenarien auf Basis wiederverwendeter Betonelemente Grundriss","white":true},
    {"type":"video","src":"media/260129_e.mp4","caption":"29.1.2026: Gründungsszenarien auf Basis wiederverwendeter Betonelemente Schnitt","white":true},
    {"type":"video","src":"media/260129_b.mp4","caption":"29.1.2026: Gründungsszenarien auf Basis wiederverwendeter Betonelemente Ansicht","white":true}
        ]'>
                            <source src="media/260129_a.mp4" type="video/mp4" />
                        </video>
                    </div>

                    <div class="cell media-cell" style="grid-column: span 1">
                        <img
                            class="thumbnail white-image"
                            src="media/260227_a.webp"
                            alt="27.2.2026"
                            data-media='[
    {"type":"image","src":"media/260227_a.webp","caption":"27.2.2026: Lageplan: Die 220 m² große Baulücke befindet sich in der Volbedingstraße 29, Leipzig.","white":true},
    {"type":"image","src":"media/260227_b.webp","caption":"27.2.2026: Grundriss Erdgeschoss","white":true},
    {"type":"image","src":"media/260227_c.webp","caption":"27.2.2026: Grundriss 1. Obergeschoss: Durch die Funktionszone der Bäder lassen sich die Wohnungen variabel verbinden.","white":true},
    {"type":"image","src":"media/260227_d.webp","caption":"27.2.2026: Grundriss 2. Obergeschoss: Dies eröffnet Flexibilität für unterschiedliche Nutzergruppen.","white":true},
    {"type":"image","src":"media/260227_e.webp","caption":"27.2.2026: Dachaufsicht","white":true},
    {"type":"image","src":"media/260227_f.webp","caption":"27.2.2026: Ansicht Nord: Die Erschliessung der Wohnungen erfolgt über einen im Hof angeordneten Laubengang.","white":true},
    {"type":"image","src":"media/260227_g.webp","caption":"27.2.2026: Ansicht Süd","white":true},
    {"type":"image","src":"media/260227_h.webp","caption":"27.2.2026: Schnitt AA","white":true}
        ]' />
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <!-- ===== Menschen ===== -->
                    <div class="cell row-title">Engagierte</div>

                    <div class="cell event" style="grid-column: span 6">
                        Alexander Barina, Michael Degener, Anne Femmer, Robert Saat, Florian Summa, Katharina Elert,
                        Samuel Schubert&nbsp;(Kollektiv)
                    </div>

                    <div class="cell event">
                        <a href="https://www.wk-consult.com" target="_blank">WKC</a>&nbsp;(Statik)
                    </div>
                    <div class="cell event" style="grid-column: span 1">Johannes Wilde&nbsp;(Kollektiv)</div>
                    <div class="cell event" style="grid-column: span 2">
                        <a href="https://abbauaufbau.de" target="_blank">Aufbau Abbau</a>&nbsp;(Forschung)
                    </div>
                    <div class="cell"></div>

                    <div class="cell event" style="grid-column: span 2">
                        Beatrice Koch, Elina Lenders, Felix Schaller&nbsp;(Kollektiv)
                    </div>
                    <div class="cell event" style="grid-column: span 6">
                        <a href="https://paulpacher.com" target="_blank">Paul Pacher</a>&nbsp;(Grafik)
                    </div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <!-- ===== Money ===== -->
                    <div class="cell row-title">Einsatz</div>

                    <div class="cell event" style="grid-column: span 6">
                        24.2.<br />
                        Bodenrichtwert: 500,00 € / m²<br />
                        Grundstücksfläche: 220 m²<br />
                        Gesamtwert: 110.000,00 €
                    </div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell event" style="grid-column: span 6">
                        14.2.
                        <br />Förderung gemäß FRL gMW pro m²: Wohnung: 6,37 € / m², Kleine Wohnung: 5,37 € / m²<br />Wohnfläche:
                        300 m²<br />Gesamt: 450.000,00 €
                    </div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>

                    <div class="cell active" style="grid-column: span 2">Geschätzte Gesamtkosten: € 1.4 Mio</div>
                </div>
            </div>
        </section>

        <div class="lightbox" id="lightbox">
            <div class="lightbox-track" id="lightbox-track"></div>
        </div>

        <div class="impressum-overlay" id="impressum-overlay">
            <div class="impressum-content">
                <p>
                    Impressum <br /><br />V29 GbR, Dieskaustraße 101, D-04229 Leipzig <br />E-Mail:
                    <a href="mailto:mail@v29.org" target="_blank">mail@v29.org</a>
                    <br />
                    Telefon: <a href="tel:+4934122392454" target="_blank">+49 341 223 924 54</a>
                    <br /><br />
                    Design &amp; Programmierung: <a href="https://paulpacher.com" target="_blank">Paul Pacher</a>
                    <br /><br /><br />
                                        Datenschutzerklärung <br />
                    <br />1. Datenschutz auf einen Blick <br />
                    Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen
                    Daten passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen
                    Sie persönlich identifiziert werden können. Ausführliche Informationen zum Thema Datenschutz
                    entnehmen Sie unserer unter diesem Text aufgeführten Datenschutzerklärung. Die Datenverarbeitung auf
                    dieser Website erfolgt durch den Websitebetreiber. Dessen Kontaktdaten können Sie dem Abschnitt
                    „Hinweis zur Verantwortlichen Stelle“ in dieser Datenschutzerklärung entnehmen. Wie erfassen wir
                    Ihre Daten: Ihre Daten werden zum einen dadurch erhoben, dass Sie uns diese mitteilen. Hierbei kann
                    es sich z. B. um Daten handeln, die Sie in ein Kontaktformular eingeben. Andere Daten werden
                    automatisch oder nach Ihrer Einwilligung beim Besuch der Website durch unsere IT- Systeme erfasst.
                    Das sind vor allem technische Daten (z. B. Internetbrowser, Betriebssystem oder Uhrzeit des
                    Seitenaufrufs). Die Erfassung dieser Daten erfolgt automatisch, sobald Sie diese Website betreten.
                    Wofür nutzen wir Ihre Daten: Ein Teil der Daten wird erhoben, um eine fehlerfreie Bereitstellung der
                    Website zu gewährleisten. Andere Daten können zur Analyse Ihres Nutzerverhaltens verwendet werden.
                    Sofern über die Website Verträge geschlossen oder angebahnt werden können, werden die übermittelten
                    Daten auch für Vertragsangebote, Bestellungen oder sonstige Auftragsanfragen verarbeitet. Welche
                    Rechte haben Sie bezüglich Ihrer Daten? Sie haben jederzeit das Recht, unentgeltlich Auskunft über
                    Herkunft, Empfänger und Zweck Ihrer gespeicherten personenbezogenen Daten zu erhalten. Sie haben
                    außerdem ein Recht, die Berichtigung oder Löschung dieser Daten zu verlangen. Wenn Sie eine
                    Einwilligung zur Datenverarbeitung erteilt haben, können Sie diese Einwilligung jederzeit für die
                    Zukunft widerrufen. Außerdem haben Sie das Recht, unter bestimmten Umständen die Einschränkung der
                    Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Des Weiteren steht Ihnen ein
                    Beschwerderecht bei der zuständigen Aufsichtsbehörde zu. Hierzu sowie zu weiteren Fragen zum Thema
                    Datenschutz können Sie sich jederzeit an uns wenden.
                    <br />
                    <br />
                    2. Hosting<br />
                    Wir hosten die Inhalte unserer Website bei folgendem Anbieter: IONOS
                    <br />
                    Anbieter ist die IONOS SE, Elgendorfer Str. 57, 56410 Montabaur (nachfolgend IONOS). Wenn Sie unsere
                    Website besuchen, erfasst IONOS verschiedene Logfiles inklusive Ihrer IP-Adressen. Details entnehmen
                    Sie der Datenschutzerklärung von IONOS:
                    <a href="https://www.ionos.de/terms-gtc/terms-privacy" target="_blank"
                        >www.ionos.de/terms-gtc/terms-privacy</a
                    >.
                    <br />
                    Die Verwendung von IONOS erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Wir haben ein
                    berechtigtes Interesse an einer möglichst zuverlässigen Darstellung unserer Website. Sofern eine
                    entsprechende Einwilligung abgefragt wurde, erfolgt die Verarbeitung ausschließlich auf Grundlage
                    von Art. 6 Abs. 1 lit. a DSGVO und § 25 Abs. 1 TDDDG, soweit die Einwilligung die Speicherung von
                    Cookies oder den Zugriff auf Informationen im Endgerät des Nutzers (z. B. Device-Fingerprinting) im
                    Sinne des TDDDG umfasst. Die Einwilligung ist jederzeit widerrufbar. Auftragsverarbeitung: Wir haben
                    einen Vertrag über Auftragsverarbeitung (AVV) zur Nutzung des oben genannten Dienstes geschlossen.
                    Hierbei handelt es sich um einen datenschutzrechtlich vorgeschriebenen Vertrag, der gewährleistet,
                    dass dieser die personenbezogenen Daten unserer Websitebesucher nur nach unseren Weisungen und unter
                    Einhaltung der DSGVO verarbeitet.
                    <br />
                    <br />
                    3. Allgemeine Hinweise und Pflichtinformationen Datenschutz: Die Betreiber dieser Seiten nehmen den
                    Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich
                    und entsprechend den gesetzlichen Datenschutzvorschriften sowie dieser Datenschutzerklärung. Wenn
                    Sie diese Website benutzen, werden verschiedene personenbezogene Daten erhoben. Personenbezogene
                    Daten sind Daten, mit denen Sie persönlich identifiziert werden können. Die vorliegende
                    Datenschutzerklärung erläutert, welche Daten wir erheben und wofür wir sie nutzen. Sie erläutert
                    auch, wie und zu welchem Zweck das geschieht. Wir weisen darauf hin, dass die Datenübertragung im
                    Internet (z. B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser
                    Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich.
                    <br />
                    Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:
                    <br />V29 GbR, Dieskaustraße 101, D-04229 Leipzig<br />
                    E-Mail:
                    <a href="mailto:mail@v29.org" target="_blank">mail@v29.org</a>
                    <br />
                    Telefon: <a href="tel:+4934122392454" target="_blank">+49 341 223 924 54</a>
                    <br />
                    Verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit
                    anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten (z. B. Namen,
                    E-Mail-Adressen o. Ä.) entscheidet.
                    <br />
                    Speicherdauer: Soweit innerhalb dieser Datenschutzerklärung keine speziellere Speicherdauer genannt
                    wurde, verbleiben Ihre personenbezogenen Daten bei uns, bis der Zweck für die Datenverarbeitung
                    entfällt. Wenn Sie ein berechtigtes Löschersuchen geltend machen oder eine Einwilligung zur
                    Datenverarbeitung widerrufen, werden Ihre Daten gelöscht, sofern wir keine anderen rechtlich
                    zulässigen Gründe für die Speicherung Ihrer personenbezogenen Daten haben (z. B. steuer- oder
                    handelsrechtliche Aufbewahrungsfristen); im letztgenannten Fall erfolgt die Löschung nach Fortfall
                    dieser Gründe.
                    <br />
                    Allgemeine Hinweise zu den Rechtsgrundlagen der Datenverarbeitung auf dieser Website: Sofern Sie in
                    die Datenverarbeitung eingewilligt haben, verarbeiten wir Ihre personenbezogenen Daten auf Grundlage
                    von Art. 6 Abs. 1 lit. a DSGVO bzw. Art. 9 Abs. 2 lit. a DSGVO, sofern besondere Datenkategorien
                    nach Art. 9 Abs. 1 DSGVO verarbeitet werden. Im Falle einer ausdrücklichen Einwilligung in die
                    Übertragung personenbezogener Daten in Drittstaaten erfolgt die Datenverarbeitung außerdem auf
                    Grundlage von Art. 49 Abs. 1 lit. a DSGVO. Sofern Sie in die Speicherung von Cookies oder in den
                    Zugriff auf Informationen in Ihr Endgerät (z. B. via Device-Fingerprinting) eingewilligt haben,
                    erfolgt die Datenverarbeitung zusätzlich auf Grundlage von § 25 Abs. 1 TDDDG. Die Einwilligung ist
                    jederzeit widerrufbar. Sind Ihre Daten zur Vertragserfüllung oder zur Durchführung vorvertraglicher
                    Maßnahmen erforderlich, verarbeiten wir Ihre Daten auf Grundlage des Art. 6 Abs. 1 lit. b DSGVO. Des
                    Weiteren verarbeiten wir Ihre Daten, sofern diese zur Erfüllung einer rechtlichen Verpflichtung
                    erforderlich sind auf Grundlage von Art. 6 Abs. 1 lit. c DSGVO. Die Datenverarbeitung kann ferner
                    auf Grundlage unseres berechtigten Interesses nach Art. 6 Abs. 1 lit. f DSGVO erfolgen. Über die
                    jeweils im Einzelfall einschlägigen Rechtsgrundlagen wird in den folgenden Absätzen dieser
                    Datenschutzerklärung informiert. Empfänger von personenbezogenen Daten Im Rahmen unserer
                    Geschäftstätigkeit arbeiten wir mit verschiedenen externen Stellen zusammen. Dabei ist teilweise
                    auch eine Übermittlung von personenbezogenen Daten an diese externen Stellen erforderlich. Wir geben
                    personenbezogene Daten nur dann an externe Stellen weiter, wenn dies im Rahmen einer
                    Vertragserfüllung erforderlich ist, wenn wir gesetzlich hierzu verpflichtet sind (z. B. Weitergabe
                    von Daten an Steuerbehörden), wenn wir ein berechtigtes Interesse nach Art. 6 Abs. 1 lit. f DSGVO an
                    der Weitergabe haben oder wenn eine sonstige Rechtsgrundlage die Datenweitergabe erlaubt. Beim
                    Einsatz von Auftragsverarbeitern geben wir personenbezogene Daten unserer Kunden nur auf Grundlage
                    eines gültigen Vertrags über Auftragsverarbeitung weiter. Im Falle einer gemeinsamen Verarbeitung
                    wird ein Vertrag über gemeinsame Verarbeitung geschlossen. Widerruf Ihrer Einwilligung zur
                    Datenverarbeitung Viele Datenverarbeitungsvorgänge sind nur mit Ihrer ausdrücklichen Einwilligung
                    möglich. Sie können eine bereits erteilte Einwilligung jederzeit widerrufen. Die Rechtmäßigkeit der
                    bis zum Widerruf erfolgten Datenverarbeitung bleibt vom Widerruf unberührt. <br />Widerspruchsrecht
                    gegen die Datenerhebung in besonderen Fällen sowie gegen Direktwerbung (Art. 21 DSGVO): WENN DIE
                    DATENVERARBEITUNG AUF GRUNDLAGE VON ART. 6 ABS. 1 LIT. E ODER F DSGVO ERFOLGT, HABEN SIE JEDERZEIT
                    DAS RECHT, AUS GRÜNDEN, DIE SICH AUS IHRER BESONDEREN SITUATION ERGEBEN, GEGEN DIE VERARBEITUNG
                    IHRER PERSONENBEZOGENEN DATEN WIDERSPRUCH EINZULEGEN; DIES GILT AUCH FÜR EIN AUF DIESE BESTIMMUNGEN
                    GESTÜTZTES PROFILING. DIE JEWEILIGE RECHTSGRUNDLAGE, AUF DENEN EINE VERARBEITUNG BERUHT, ENTNEHMEN
                    SIE DIESER DATENSCHUTZERKLÄRUNG. WENN SIE WIDERSPRUCH EINLEGEN, WERDEN WIR IHRE BETROFFENEN
                    PERSONENBEZOGENEN DATEN NICHT MEHR VERARBEITEN, ES SEI DENN, WIR KÖNNEN ZWINGENDE SCHUTZWÜRDIGE
                    GRÜNDE FÜR DIE VERARBEITUNG NACHWEISEN, DIE IHRE INTERESSEN, RECHTE UND FREIHEITEN ÜBERWIEGEN ODER
                    DIE VERARBEITUNG DIENT DER GELTENDMACHUNG, AUSÜBUNG ODER VERTEIDIGUNG VON RECHTSANSPRÜCHEN
                    (WIDERSPRUCH NACH ART. 21 ABS. 1 DSGVO). WERDEN IHRE PERSONENBEZOGENEN DATEN VERARBEITET, UM
                    DIREKTWERBUNG ZU BETREIBEN, SO HABEN SIE DAS RECHT, JEDERZEIT WIDERSPRUCH GEGEN DIE VERARBEITUNG SIE
                    BETREFFENDER PERSONENBEZOGENER DATEN ZUM ZWECKE DERARTIGER WERBUNG EINZULEGEN; DIES GILT AUCH FÜR
                    DAS PROFILING, SOWEIT ES MIT SOLCHER DIREKTWERBUNG IN VERBINDUNG STEHT. WENN SIE WIDERSPRECHEN,
                    WERDEN IHRE PERSONENBEZOGENEN DATEN ANSCHLIESSEND NICHT MEHR ZUM ZWECKE DER DIREKTWERBUNG VERWENDET
                    (WIDERSPRUCH NACH ART. 21 ABS. 2 DSGVO). <br />
                    Beschwerderecht bei der zuständigen Aufsichtsbehörde: Im Falle von Verstößen gegen die DSGVO steht
                    den Betroffenen ein Beschwerderecht bei einer Aufsichtsbehörde, insbesondere in dem Mitgliedstaat
                    ihres gewöhnlichen Aufenthalts, ihres Arbeitsplatzes oder des Orts des mutmaßlichen Verstoßes zu.
                    Das Beschwerderecht besteht unbeschadet anderweitiger verwaltungsrechtlicher oder gerichtlicher
                    Rechtsbehelfe.
                    <br />
                    Recht auf Datenübertragbarkeit: Sie haben das Recht, Daten, die wir auf Grundlage Ihrer Einwilligung
                    oder in Erfüllung eines Vertrags automatisiert verarbeiten, an sich oder an einen Dritten in einem
                    gängigen, maschinenlesbaren Format aushändigen zu lassen. Sofern Sie die direkte Übertragung der
                    Daten an einen anderen Verantwortlichen verlangen, erfolgt dies nur, soweit es technisch machbar
                    ist.
                    <br />
                    Auskunft, Berichtigung und Löschung: Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen
                    jederzeit das Recht auf unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten,
                    deren Herkunft und Empfänger und den Zweck der Datenverarbeitung und ggf. ein Recht auf Berichtigung
                    oder Löschung dieser Daten. Hierzu sowie zu weiteren Fragen zum Thema personenbezogene Daten können
                    Sie sich jederzeit an uns wenden.
                    <br />Recht auf Einschränkung der Verarbeitung: Sie haben das Recht, die Einschränkung der
                    Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Hierzu können Sie sich jederzeit an uns
                    wenden. Das Recht auf Einschränkung der Verarbeitung besteht in folgenden Fällen: Wenn Sie die
                    Richtigkeit Ihrer bei uns gespeicherten personenbezogenen Daten bestreiten, benötigen wir in der
                    Regel Zeit, um dies zu überprüfen. Für die Dauer der Prüfung haben Sie das Recht, die Einschränkung
                    der Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Wenn die Verarbeitung Ihrer
                    personenbezogenen Daten unrechtmäßig geschah/geschieht, können Sie statt der Löschung die
                    Einschränkung der Datenverarbeitung verlangen. Wenn wir Ihre personenbezogenen Daten nicht mehr
                    benötigen, Sie sie jedoch zur Ausübung, Verteidigung oder Geltendmachung von Rechtsansprüchen
                    benötigen, haben Sie das Recht, statt der Löschung die Einschränkung der Verarbeitung Ihrer
                    personenbezogenen Daten zu verlangen. Wenn Sie einen Widerspruch nach Art. 21 Abs. 1 DSGVO eingelegt
                    haben, muss eine Abwägung zwischen Ihren und unseren Interessen vorgenommen werden. Solange noch
                    nicht feststeht, wessen Interessen überwiegen, haben Sie das Recht, die Einschränkung der
                    Verarbeitung Ihrer personenbezogenen Daten zu verlangen. Wenn Sie die Verarbeitung Ihrer
                    personenbezogenen Daten eingeschränkt haben, dürfen diese Daten – von ihrer Speicherung abgesehen –
                    nur mit Ihrer Einwilligung oder zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen
                    oder zum Schutz der Rechte einer anderen natürlichen oder juristischen Person oder aus Gründen eines
                    wichtigen öffentlichen Interesses der Europäischen Union oder eines Mitgliedstaats verarbeitet
                    werden.
                    <br />
                    <br />
                    4. Datenerfassung auf dieser Website: <br />
                    Anfrage per E-Mail, Telefon oder Telefax: Wenn Sie uns per E-Mail, Telefon oder Telefax
                    kontaktieren, wird Ihre Anfrage inklusive aller daraus hervorgehenden personenbezogenen Daten (Name,
                    Anfrage) zum Zwecke der Bearbeitung Ihres Anliegens bei uns gespeichert und verarbeitet. Diese Daten
                    geben wir nicht ohne Ihre Einwilligung weiter. Die Verarbeitung dieser Daten erfolgt auf Grundlage
                    von Art. 6 Abs. 1 lit. b DSGVO, sofern Ihre Anfrage mit der Erfüllung eines Vertrags zusammenhängt
                    oder zur Durchführung vorvertraglicher Maßnahmen erforderlich ist. In allen übrigen Fällen beruht
                    die Verarbeitung auf unserem berechtigten Interesse an der effektiven Bearbeitung der an uns
                    gerichteten Anfragen (Art. 6 Abs. 1 lit. f DSGVO) oder auf Ihrer Einwilligung (Art. 6 Abs. 1 lit. a
                    DSGVO) sofern diese abgefragt wurde; die Einwilligung ist jederzeit widerrufbar. Die von Ihnen an
                    uns per Kontaktanfragen übersandten Daten verbleiben bei uns, bis Sie uns zur Löschung auffordern,
                    Ihre Einwilligung zur Speicherung widerrufen oder der Zweck für die Datenspeicherung entfällt (z. B.
                    nach abgeschlossener Bearbeitung Ihres Anliegens). Zwingende gesetzliche Bestimmungen – insbesondere
                    gesetzliche Aufbewahrungsfristen – bleiben unberührt.
                    <br />
                    <br />Quelle:
                    <a href="https://www.e-recht24.de" target="_blank">www.e-recht24.de</a>
                </p>
                <button class="impressum-close" id="impressum-close">Schließen</button>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
