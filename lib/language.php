<?php

if (!isset($_SESSION)) {
    $_SESSION = array();   
}

require_once("langTools.php");    // language functions

/* template for copy
$lang['']["FR"] = "";
$lang['']["DE"] = "";
$lang['']["EN"] = "";
*/

// The below -1 entry is needed to allow langTools.php
// to detect the availability of the chosen language
$lang[-1]["FR"] = "Français";
$lang[-1]["DE"] = "Deutsch";
$lang[-1]["EN"] = "English";

$lang['language']["FR"] = "Français";
$lang['language']["DE"] = "Deutsch";
$lang['language']["EN"] = "English";

$lang['name']["FR"] = "APP-ID";
$lang['name']["DE"] = "APP-ID";
$lang['name']["EN"] = "APP-ID";

$lang['back']["FR"] = "Retour";
$lang['back']["DE"] = "Zurück";
$lang['back']["EN"] = "Go back";

$lang['next']["FR"] = "Continuer";
$lang['next']["DE"] = "Weiter";
$lang['next']["EN"] = "Next";

$lang['restart']["FR"] = "";
$lang['restart']["DE"] = "Neu starten";
$lang['restart']["EN"] = "Start again";

$lang['genericError']["FR"] = "";
$lang['genericError']["DE"] = "Es tut uns Leid, aber ein internes Problem ist
                               aufgetreten. Bitte kontaktieren Sie uns unter
                               ".SUPPORT_EMAIL.".";
$lang['genericError']["EN"] = "We are sorry, but an internal error occured. 
                               Please contact us at ".SUPPORT_EMAIL.".";

$lang['invalidSession']["FR"] = "";
$lang['invalidSession']["DE"] = "Leider scheint Ihre Session ungültig. Bitte stellen
                                 Sie sicher dass <b>JavaScript</b> und <b>Cookies</>
                                 aktiviert sind um diesen Service zu nutzen.";
$lang['invalidSession']["EN"] = "We are sorry, but your session seems invalid. Please
                                 make sure you activated both <b>JavaScript</b> and
                                 <b>Cookies</b> in order to use this service.";

$lang['youWereToFast']["FR"] = "";
$lang['youWereToFast']["DE"] = "Scheint Sie haben die Seite nicht aufmerksam gelesen.
                                Bitte versuchen Sie es erneut von Anfang an.";
$lang['youWereToFast']["EN"] = "Looks like you did not carefully read the page.
                                Please try again from the beginning.";                                 


$lang['intro']["FR"] = "";
$lang['intro']["DE"] = "<p>Willkommen zum ".$lang['name']["DE"]." service.</p>
                        <p>Die APP-ID kann als Passwort für Sie arbeiten, passend für
                        verschiedene Anwendungsfälle. Zum Beispiel im Gesundheitswesen,
                        in der Finanzwelt und bei persönlichen Anwendungen und Dienstleistungen.</p>";
$lang['intro']["EN"] = "<p>Welcome to the ".$lang['name']["EN"]." service.</p>
                        <p>The APP-ID can work as a password for you, suitable for several use cases.
                        For example in health, finance and personal applications and services.</p>";

$lang['pidIsLocked']["FR"] = "";
$lang['pidIsLocked']["DE"] = "Leider hat es <b>zu Oft nicht geklappt</b>. Bitte versuchen Sie es
                              erst in mindestens 10 Minuten noch einmal.";
$lang['pidIsLocked']["EN"] = "We are sorry, but <b>this failed to often</b>. Please try again in
                              at least 10 minutes.";

// FOOTER
$lang['lnkAbout']["FR"] = "";
$lang['lnkAbout']["DE"] = "Über";
$lang['lnkAbout']["EN"] = "About";

$lang['lnkFAQ']["FR"] = "";
$lang['lnkFAQ']["DE"] = "FAQ";
$lang['lnkFAQ']["EN"] = "FAQ";

$lang['lnkContact']["FR"] = "";
$lang['lnkContact']["DE"] = "Support-Kontakt";
$lang['lnkContact']["EN"] = "Support Contact";

$lang['lnkImprint']["FR"] = "";
$lang['lnkImprint']["DE"] = "Impressum";
$lang['lnkImprint']["EN"] = "Imprint";

$lang['lnkPrivacy']["FR"] = "";
$lang['lnkPrivacy']["DE"] = "Datenschutz und Privatsphäre";
$lang['lnkPrivacy']["EN"] = "Data Protection &amp Privacy";

// STEP 0 -- start page
$lang['request']["FR"] = "";
$lang['request']["DE"] = "<p>Willkommen. Bitte folgen Sie den Anweisung um eine
                         persönliche APP-ID zu generieren oder abzufragen.</p><br/>
                         <p>Bitte sagen Sie uns aus welchem Land Sie kommen:</p>";
                         
$lang['request']["EN"] = "<p>Welcome. Please follow the instructions to generate or
                          request your personal APP-ID:</p><br/>
                          <p>Please tell us from which country you are:</p>";

// STEP 1 -- ask identity
$lang['idQuestion']["FR"]["GER"] = "";
$lang['idQuestion']["DE"]["GER"] = "<p>Bitte geben Sie Ihre Personalausweis-Nummer ein:</p>";
$lang['idQuestion']["EN"]["GER"] = "<p>Please enter your \"Personalausweis-Nummer\":</p>";
$lang['idHelp']["FR"]["GER"] = "";
$lang['idHelp']["DE"]["GER"] = "TIPP: Die Nummer ist üblicherweise in der oberen rechten Ecke.";
$lang['idHelp']["EN"]["GER"] = "HINT: The number is typically located in the upper right corner.";

$lang['idQuestion']["FR"]["LUX"] = "";
$lang['idQuestion']["DE"]["LUX"] = "<p>Bitte geben Sie Ihre \"N° Carte d'Identité\" ein:</p>";
$lang['idQuestion']["EN"]["LUX"] = "<p>Please enter your \"N° Carte d'Identité\":</p>";
$lang['idHelp']["FR"]["LUX"] = "";
$lang['idHelp']["DE"]["LUX"] = "TIPP: Die Nummer ist üblicherweise in der unteren Mitte Ihres Ausweises.";
$lang['idHelp']["EN"]["LUX"] = "HINT: The number is typically located in the lower half of your id card.";

$lang['countryNotSupported']["FR"] = "";
$lang['countryNotSupported']["DE"] = "Es tut uns Leid, aber Ihr Land wird momentan nicht unterstützt.
                                      <br/>Bitte kontaktieren Sie unseren Support (siehe Fußbereich).";
$lang['countryNotSupported']["EN"] = "We are sorry, but your country is currently not supported.
                                      <br/>Please contact our support (see footer).";

$lang['invalidCountry']["FR"] = "";
$lang['invalidCountry']["DE"] = "Bitte wählen Sie ein gültiges Land!";
$lang['invalidCountry']["EN"] = "Please select a valid country!";

// STEP 2 -- identity check and validation
$lang['invalidId']["FR"] = "";
$lang['invalidId']["DE"] = "Die eingegebene ID ist ungültig. Bitte geben Sie die Nummer gewissenhaft ein.";
$lang['invalidId']["EN"] = "The ID you entered is not valid. Please be very careful when entering.";

$lang['introNewIdentity']["FR"] = "";
$lang['introNewIdentity']["DE"] = "<p>Scheinbar haben Sie noch keine APP-ID. Um Ihnen
                                   eine neue zu generieren, wählen Sie bitte zuerst eine
                                   Sicherheitsfrage und geben Sie die passende Antwort ein.</p>";
$lang['introNewIdentity']["EN"] = "<p>Seems you do not yet have an APP-ID. In order to
                                   create a new one for you, please select a security
                                   question and type in your answer.</p>";

$lang['introExistingIdentity']["FR"] = "";
$lang['introExistingIdentity']["DE"] = "<p>Sie haben bereits eine APP-ID. Damit wir Ihnen
                                    diese geben können, müssen Sie die Sicherheitsfrage
                                    beantworten, welche Sie für diesen Zweck gewählt haben.</p>";
$lang['introExistingIdentity']["EN"] = "<p>You already have an APP-ID. In order to
                                    tell you, you need to answer the security question
                                    you told us to use in this case.</p>";
                                                                        

// available security questions
$lang['secQuestion']["FR"][0] = "";
$lang['secQuestion']["DE"][0] = "Wie ist der Namen Ihres besten Kindheits-Freundin/Freundes?";
$lang['secQuestion']["EN"][0] = "What is the name of your favorite childhood friend?";

$lang['secQuestion']["FR"][1] = "";
$lang['secQuestion']["DE"][1] = "Wie war der Name deines ersten Stofftieres?";
$lang['secQuestion']["EN"][1] = "What was the name of your first stuffed animal?";

$lang['secQuestion']["FR"][2] = "";
$lang['secQuestion']["DE"][2] = "Wo waren Sie, als Sie das erste Mal von 9/11 gehört haben?";
$lang['secQuestion']["EN"][2] = "Where were you when you first heard about 9/11?";

$lang['secQuestion']["FR"][3] = "";
$lang['secQuestion']["DE"][3] = "Die letzten 4 Ziffern Ihrer Telefonnummer aus der Kindheit?";
$lang['secQuestion']["EN"][3] = "The last four digits of your childhood telephone number?";

$lang['secAnswer']["FR"] = "";
$lang['secAnswer']["DE"] = "<p>Wie lautet die Antwort zu der oben gewählten Sicherheitsfrage?</p>";
$lang['secAnswer']["EN"] = "<p>What is your answer to the above chosen security question?</p>";

$lang['secAnswerHint']["FR"] = "";
$lang['secAnswerHint']["DE"] = "<p>HINWEIS: Wir kümmern uns nicht um Groß- und Kleinschreibung und einige
                                Sonderzeichen. Bitte denken Sie daran, dass Sie sich Ihre Antwort für
                                die Zukunft merken müssen!</p>
                                <p>Bitte stellen Sie sicher, dass diese Informationen
                                <b>nicht öffentlich verfügbar ist</b> (z.B. in Social Networks oder
                                lokale Presse) und <b>nicht leicht zu erraten</b> ist.</p>";
$lang['secAnswerHint']["EN"] = "<p>HINT: We do not care about uppercase or lowercase and some
                                special characters. Please keep in mind that you need to remember
                                your answer in the future!</p>
                                <p>Please make sure that this information is
                                <b>not public available</b> (for example in Social Networks or
                                local press) and <b>not easy to guess</b>.</p>";

$lang['secAnswerHintSimple']["FR"] = "";
$lang['secAnswerHintSimple']["DE"] = "<p>TIPP: Wir achten nicht auf Groß/Kleinschreibung und
                                      einige Sonderzeichen.</p>";
$lang['secAnswerHintSimple']["EN"] = "<p>HINT: We do not care about uppercase or lowercase and 
                                      some special characters.</p>";

$lang['answerDefault']["FR"] = ""; // keep short!
$lang['answerDefault']["DE"] = "Die Antwort hier eingeben"; // keep short!
$lang['answerDefault']["EN"] = "Enter your answer here"; // keep short!

// STEP 3 -- existing identity, ask question

$lang['yourAppId']["FR"] = "";
$lang['yourAppId']["DE"] = "<p>Wir haben Ihnen eine APP-ID generiert:</p>
                            <div class=\"appId\"><APPID></div>";
$lang['yourAppId']["EN"] = "<p>We created a new APP-ID for you:</p>
                            <div class=\"appId\"><APPID></div>";

$lang['idFinalHelp']["FR"] = "";
$lang['idFinalHelp']["DE"] = "<p>Bitte kopieren und speichern Sie diese APP-ID an einem sicheren
                              Ort. Idealerweise nutzen Sie einen <b>Passwort-Manager</b>.</p>
                              <p>Handschriftliche Notizen müssen sehr sorgfältig gemacht werden
                              und dürfen nicht offen gelagert werden!</p>";
$lang['idFinalHelp']["EN"] = "<p>Please copy and save this APP-ID in a safe place. Ideally use
                              a <b>password manager</b>.</p>
                              <p>Handwritten notes must be taken very carefully and should not
                              be stored exposed!</p>";

$lang['invalidSecAnswer']["FR"] = "";
$lang['invalidSecAnswer']["DE"] = "Bitte geben Sie eine Antwort ein die aus 2 bis maximal 100
                                   regulären Zeichen oder Ziffern besteht.";
$lang['invalidSecAnswer']["EN"] = "Please enter an answer consisting of 2 to a maximum of 100
                                   regular characters or numbers.";

// STEP 4 -- Show existing

$lang['invalidAnswer']["FR"] = "";
$lang['invalidAnswer']["DE"] = "Das war leider die falsche Antwort.<br/><br/>Bitte
                                überlegen Sie nochmal und versuchen Sie es erneut
                                (bis zu fünf Mal).";
$lang['invalidAnswer']["EN"] = "Sorry, but this was the wrong answer.<br/><br/>
                                Please think carefully and retry (up to five times).";

$lang['yourExistingAppId']["FR"] = "";
$lang['yourExistingAppId']["DE"] = "<p>Das ist Ihre bestehende APP-ID:</p>
                                   <div class=\"appId\"><APPID></div>";
$lang['yourExistingAppId']["EN"] = "<p>This is your existing APP-ID:</p>
                                   <div class=\"appId\"><APPID></div>";

$lang['aboutHeader']["FR"] = "";
$lang['aboutHeader']["DE"] = "<h1>Über</h1>";
$lang['aboutHeader']["EN"] = "<h1>About</h1>";

$lang['aboutContent']["FR"] = "";
$lang['aboutContent']["DE"] = "<p>Die APP-ID kann als Passwort für Sie funktionieren, passend
                               für verschiedene Anwendungsfälle. Zum Beispiel im Gesundheitswesen,
                               im Finanzwesen und für persönliche Anwendungen und Dienste.</p>
                               <p>Dieser Dienst wird kostenlos zur Verfügung gestellt.</p>
                               <h2>Die Idee hinter APP-ID</h2>
                               <p>Einige Dienste wie VACCINATOR und andere benötigen von den Endnutzern
                               ein Passwort, um sicherzustellen dass Daten verschlüsselt 
                               gespeichert werden. Aufgrund der Natur des Menschen können Passwörter
                               aber verloren gehen. In diesem Fall gibt es keine Möglichkeit, die
                               Daten wieder herzustellen und das kann für viele Unternehmen gefährlich
                               werden. Um dieses Problem zu lösen, bietet Ihnen APP-ID
                               ein Passwort (APP-ID), das niemals
                               vergessen wird, denn Sie können es erneut anfordern, falls Sie
                               es nicht mehr wissen. Damit können Sie Ihre
                               Business-Anwendungen schützen und Sie können sicher sein, dass
                               das Vergessen der APP-ID Sie nicht behindert.</p>
                               <p>Eine weitere wichtige Idee hinter APP-ID war es, die Verwendung von
                               Handys und Hardware zu vermeiden. Handynummern werden sich ändern und
                               Hardware kann auch verloren gehen, veralten oder wird
                               auf einigen Betriebssystemen schlecht unterstützt.</p>";
$lang['aboutContent']["EN"] = "<p>The APP-ID can work as a password for you, suitable
                               for several use cases. For example in health, finance and
                               personal applications and services.</p>
                               <p>This service is provided for free.</p>
                               <h2>The idea behind APP-ID</h2>
                               <p>Some services like VACCINATOR and others need end users
                               to enter some password to make sure that content is
                               saved encrypted. Due to the nature of humans, passwords may
                               become lost. In this case, there is no way to restore
                               the data and this may become dangerous for many
                               businesses. In order to solve this issue, APP-ID provides
                               you with a password (APP-ID) that can never become
                               forgotten because you can request it again in case you
                               don't know anymore. By this, you can continue your
                               business and applications, being sure that forgetting
                               the APP-ID does not hinder you.</p>
                               <p>Another major idea behind APP-ID was to prevent using
                               mobiles and hardware. Mobile numbers will change and
                               hardware also can get lost, may become old or is
                               badly supported on some operating systems.</p>";

$lang['faqHeader']["FR"] = "";
$lang['faqHeader']["DE"] = "<h1>FAQ</h1>";
$lang['faqHeader']["EN"] = "<h1>FAQ</h1>";

$lang['faqContent']["FR"] = "";
$lang['faqContent']["DE"] = "<h2>Warum ist der Dienst kostenlos?</h2>
                             <p>Wir verlangen kein Geld, weil die auf der APP-ID 
                             basierenden Dienste für den Service bezahlen. Dies bedeutet
                             nicht, dass diese Zugang zu den Daten des APP-ID
                             Dienstes haben!</p>
                             <h2>Es scheint nicht schwer zu sein, an die APP-ID von
                             jemand anderes zu gelangen?</h2>
                             <p>Um die APP-ID abzurufen, müssen Sie zunächst die 
                             zugehörige ID wissen (z.B. Pass- oder Personalausweis). Und sogar
                             wenn Sie diese kennen, gilt es noch die Sicherheitsfrage
                             richtig zu beantworten. </p>
                             <p>Bitte beachten Sie, dass Sie durch Kenntnis der App-ID
                             keinen Zugriff auf Daten erhalten. Sie ist nur zusammen mit
                             den Login-Informationen des Dienstes sinnvoll, der die
                             APP-ID verwendet. Die APP-ID alleine ist nutzlos.</p>
                             <h2>Und wenn ich die Antwort auf meine Sicherheitsfrage vergessen habe?</h2>
                             <p>Das ist schlecht. Bitte melden Sie sich unter ".SUPPORT_EMAIL.".
                             Wir werden Ihnen helfen, wenn Sie uns Ihre Identität und
                             die ID durch Vorlage des Ausweisdokuments beweisen können.</p>
                             <h2>Ich habe meine APP-ID verloren. Wie bekomme ich sie wieder?</h2>
                             <p>Füllen Sie diese Webseite aus und beantworten Sie die
                             Sicherheitsfrage. Wir zeigen Ihnen dann Ihre APP-ID, welche
                             wir vor einer Weile für Sie generiert haben.</p>
                             <h2>Scheinbar hat jemand meine ID (zB Ausweis-ID) schon registriert!</h2>
                             <p>Das ist nicht sehr wahrscheinlich, aber es gilt das selbe wie 
                             die Antwort auf die Frage wenn Sie Ihre Antwort auf die 
                             Sicherheitsfrage vergessen haben.</p>
                             <h2>Ich wurde blockiert?</h2>
                             <p>Das passiert wenn Sie mehr als ".LOCK_AFTER_FAILED_ATTEMPTS." Mal
                             die falsche Antwort auf die Sicherheitsfrage eingegeben haben.
                             Warten Sie 10 Minuten und versuchen Sie es dann erneut.</p>
                             <h2>Ich habe eine ungültige Session?</h2>
                             <p>Stellen Sie sicher dass Ihr Webbrowser Cookies zulässt!</p>";
$lang['faqContent']["EN"] = "<h2>Why is the service for free?</h2>
                             <p>We do not charge money because the services relying on the
                             APP-ID are paying for the service. This does not mean that
                             they have access to the data of this service!</p>
                             <h2>It does not seem hard to get access to the APP-ID of
                             someone else?</h2>
                             <p>In order to retrieve the APP-ID, you first need to know
                             the ID (eg passport ID or national identity ID). And even
                             if you know, there is the security question to answer.</p>
                             <p>Please note that you do not get any data by knowing the
                             APP-ID. It is only usefull together with login information
                             to the service that makes use of the APP-ID. The APP-ID
                             alone is useless.</p>
                             <h2>What if I do not remember my security answer?</h2>
                             <p>This is bad. Please contact us at ".SUPPORT_EMAIL.".
                             There we will help you if you can show us your identity
                             together with the number in real (eg showing passport).</p>
                             <h2>I lost my APP-ID. How to get it?</h2>
                             <p>Just fill in this page and answer your security
                             question. We will then show you your APP-ID, generated
                             for you some time ago.</p>
                             <h2>Seems someone else used my ID (eg passport ID) before!</h2>
                             <p>This is not very likely but here the same applies as for
                             forgetting the answer to your security question above.</p>
                             <h2>I got blocked?</h2>
                             <p>This may happen if you entered the wrong answer to your
                             security question for more than ".LOCK_AFTER_FAILED_ATTEMPTS."
                             times. Just wait 10 minutes and try again.</p>
                             <h2>I got some invalid session?</h2>
                             <p>Please make sure that your web-browser accepts cookies!</p>";

$lang['contactHeader']["FR"] = "";
$lang['contactHeader']["DE"] = "<h1>Support-Kontakt</h1>";
$lang['contactHeader']["EN"] = "<h1>Support Contact</h1>";

$lang['contactContent']["FR"] = "";
$lang['contactContent']["DE"] = "<p>Lesen Sie bitte zuerst die <a href=\"?s=".STEP_FAQ."\">FAQ</a>.</p>
                                 <p>Wann das Ihre Fragen nicht beantwortet, wenden Sie sich 
                                 bitte an ".SUPPORT_EMAIL.".</p>";
$lang['contactContent']["EN"] = "<p>Please first read the <a href=\"?s=".STEP_FAQ."\">FAQ</a>.</p>
                                 <p>If this does not answer your questions, please contact
                                 us at ".SUPPORT_EMAIL.".</p>";

$lang['imprintHeader']["FR"] = "";
$lang['imprintHeader']["DE"] = "<h1>Impressum</h1>";
$lang['imprintHeader']["EN"] = "<h1>Imprint</h1>";

$lang['imprintContent']["FR"] = "";
$lang['imprintContent']["DE"] = "<p>Dieser Service wird betrieben durch:</p>
                                <p><b>Company S.A.</b><br/>
                                Street and Number<br/>
                                City<br/>
                                Country</p>
                                <p>E-Mail: ".SUPPORT_EMAIL.".</p>";
$lang['imprintContent']["EN"] = "<p>This service is operated by:</p>
                                <p><b>Company S.A.</b><br/>
                                Street and Number<br/>
                                City<br/>
                                Country</p>
                                <p>email: ".SUPPORT_EMAIL.".</p>";

$lang['privacyHeader']["FR"] = "";
$lang['privacyHeader']["DE"] = "<h1>Datenschutz und Privatsphäre</h1>";
$lang['privacyHeader']["EN"] = "<h1>Privacy &amp Data Protection</h1>";

$lang['privacyContent']["FR"] = "";
$lang['privacyContent']["DE"] = "<p>Natürlich speichern wir alle Daten die Sie eingeben,
                                 inclusive der Ausweis-ID, dem Land, der Sicherheitsfrage
                                 und deren Antwort, Datum und Uhrzeit zusammen mit der
                                 für Sie generierten APP-ID.</p>
                                 <p>Die Daten werden nicht verkauft und nicht an Dritte
                                 weiter gegeben.</p>
                                 <p>Wenn Sie mehr Fragen zu Datenschutz und Privatsphäre haben,
                                 <a href=\"?s=".STEP_CONTACT."\">nehmen Sie bitte Kontakt auf</a>.</p>";
$lang['privacyContent']["EN"] = "<p>Of course, we save all values you entered, including ID, 
                                 your Country, your security question and the answer, date and
                                 time information together with the APP-ID we generated for
                                 you.</p>
                                 <p>We neither sell nor share this information with any third
                                 party.</p>
                                 <p>If you have any questions regarding Privacy and Data
                                 Protection, please <a href=\"?s=".STEP_CONTACT."\">contact us</a>.</p>";
                                 
?>