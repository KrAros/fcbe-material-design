<?PHP
##################################################################################
#    FANTACALCIOBAZAR EVOLUTION
#    Copyright (C) 2003-2006 by Antonello Onida (fantacalciobazar@sassarionline.net)
#    Copyright (C) 2001-2002 by Marco Maria Francesco De Santis (marcods@gmx.net)
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
##################################################################################
header("Cache-control: max-age=3600, must-revalidate");
session_start();
require("./dati/dati_gen.php");
require("./inc/funzioni.php");
include("./header.php");
?>
<div class="contenuto">
	<div id="articoli">
<table cellpadding="15" cellspacing="5" border="0" width="750" align="center">
    <tr>
      <td valign="top" class="pagina-sinistra-unica"><center>
        <table width="50%"  border="0" align="right" cellpadding="5" cellspacing="0">
          <tr>
            <td ><p class="slogan">Questa &egrave; una traduzione italiana non ufficiale della Licenza
                Pubblica Generica GNU. Non &egrave; pubblicata dalla Free Software Foundation
                e non ha valore legale nell'esprimere i termini di distribuzione
                del software che usa la licenza GPL. Solo la versione originale
                in inglese della licenza ha valore legale. Ad ogni modo, speriamo
                che questa traduzione aiuti le persone di lingua italiana a capire
                meglio il significato della licenza GPL. <br />
                <br />
				This is an unofficial translation of the GNU General Public
                License into Italian. It was not published by the Free Software
                Foundation, and does not legally state the distribution terms
                for software that uses the GNU GPL - only the original English
                text of the GNU GPL does that. However, we hope that this translationwill
            help Italian speakers understand the GNU GPL better. </p></td>
          </tr>
        </table>
        
        <h3><b>LICENZA
                PUBBLICA GENERICA (GPL) DEL PROGETTO GNU <br />
      Versione 2, Giugno 1991 </b>
        </h3>
      </center>
        <div align="justify">
          <p><i>Copyright (C) 1989, 1991 Free
              Software Foundation, Inc. - 675 Mass Ave, Cambridge, MA 02139,
              USA Tutti possono copiare e distribuire copie letterali di questo
              documento di licenza, ma non &egrave; permesso modificarlo. </i></p>
        </div>
        <p align="justify"><b>Preambolo </b></p>
        <p align="justify">Le licenze per la maggioranza
            dei programmi hanno lo scopo di togliere all'utente la libert&agrave; di
            condividerlo e di modificarlo. Al contrario, la Licenza Pubblica
            Generica GNU &egrave; intesa a garantire la libert&agrave; di condividere
            e modificare il free software, al fine di assicurare che i programmi
            siano &quot;liberi&quot; per tutti i loro utenti. Questa Licenza
            si applica alla maggioranza dei programmi della Free Software Foundation
            e a ogni altro programma i cui autori hanno scelto questa Licenza.
            Alcuni altri programmi della Free Software Foundation sono invece
            coperti dalla Licenza Pubblica Generica per Librerie (LGPL). Chiunque
            pu&ograve; usare questa Licenza per i propri programmi. </p>
        <p align="justify">Quando si parla di free software,
            ci si riferisce alla libert&agrave;, non al prezzo. Le nostre Licenze
            (la GPL e la LGPL) sono progettate per assicurare che ciascuno abbia
            la libert&agrave; di distribuire copie del software libero (e farsi
            pagare per questo, se vuole), che ciascuno riceva il codice sorgente
            o che lo possa ottenere se lo desidera, che ciascuno possa modificare
            il programma o usarne delle parti in nuovi programmi liberi e che
            ciascuno sappia di potere fare queste cose. </p>
        <p align="justify">Per proteggere i diritti dell'utente,
            abbiamo bisogno di creare delle restrizioni che vietino a chiunque
            di negare questi diritti o di chiedere di rinunciarvi. Queste restrizioni
            si traducono in certe responsabilit&agrave; per chi distribuisce
            copie del software e per chi lo modifica. </p>
        <p align="justify">Per esempio, chi distribuisce
            copie di un Programma coperto da GPL, sia gratuitamente sia facendosi
            pagare, deve dare agli acquirenti tutti i diritti che ha ricevuto.
            Deve anche assicurarsi che gli acquirenti ricevano o possano ricevere
            il codice sorgente. E deve mostrar loro queste condizioni di Licenza,
            in modo che conoscano i loro diritti. </p>
        <p align="justify">Proteggiamo i diritti dell'utente
            attraverso due azioni: (1) proteggendo il software con un diritto
            d'autore (una nota di copyright), e (2) offrendo una Licenza che
            concede il permesso legale di copiare, distribuire e/o modificare
            il Programma. </p>
        <p align="justify">Infine, per proteggere ogni
            autore e noi stessi, vogliamo assicurarci che ognuno capisca che
            non ci sono garanzie per i programmi coperti da GPL. Se il Programma
            viene modificato da qualcun altro e ridistribuito, vogliamo che gli
            acquirenti sappiano che ci&ograve; che hanno non &egrave; l'originale,
            in modo che ogni problema introdotto da altri non si rifletta sulla
            reputazione degli autori originari. </p>
        <p align="justify">Infine, ogni programma libero &egrave; costantemente
            minacciato dai brevetti sui programmi. Vogliamo evitare il pericolo
            che chi ridistribuisce un Programma libero ottenga brevetti personali,
            rendendo perci&ograve; il Programma una cosa di sua propriet&agrave;.
            Per prevenire questo, abbiamo chiarito che ogni prodotto brevettato
            debba essere reso disponibile perch&eacute; tutti ne usufruiscano
            liberamente; se l'uso del prodotto deve sottostare a restrizioni
            allora tale prodotto non deve essere distribuito affatto. </p>
        <p align="justify">Seguono i termini e le condizioni
            precisi per la copia, la distribuzione e la modifica. </p>
        <p align="justify"><strong>LICENZA PUBBLICA GENERICA
              GNU - TERMINI E CONDIZIONI PER LA COPIA, LA DISTRIBUZIONE E LA
              MODIFICA </strong></p>
        <p align="justify">0. Questa Licenza si applica
            a ogni Programma o altra opera che contenga una nota da parte del
            detentore del diritto d'autore che dica che tale opera pu&ograve; essere
            distribuita nei termini di questa Licenza Pubblica Generica. Il termine
            ?Programma? nel seguito indica ognuno di questi programmi o lavori,
            e l'espressione ?lavoro basato sul Programma? indica sia il Programma
            sia ogni opera considerata ?derivata? in base alla legge sul diritto
            d'autore: cio&egrave; un lavoro contenente il Programma o una porzione
            di esso, sia letteralmente sia modificato e/o tradotto in un'altra
            lingua; da qui in avanti, la traduzione &egrave; in ogni caso considerata
            una ?modifica?. Vengono ora elencati i diritti dei detentori di licenza. </p>
        <p align="justify">Attivit&agrave; diverse dalla
            copiatura, distribuzione e modifica non sono coperte da questa Licenza
            e sono al di fuori della sua influenza. L'atto di eseguire il programma
            non viene limitato, e l'output del programma &egrave; coperto da
            questa Licenza solo se il suo contenuto costituisce un lavoro basato
            sul Programma (indipendentemente dal fatto che sia stato creato eseguendo
            il Programma). In base alla natura del Programma il suo output pu&ograve; essere
            o meno coperto da questa Licenza. </p>
        <p align="justify">1. &egrave; lecito copiare e
            distribuire copie letterali del codice sorgente del Programma cos&igrave; come
            viene ricevuto, con qualsiasi mezzo, a condizione che venga riprodotta
            chiaramente su ogni copia un'appropriata nota di diritto d'autore
            e di assenza di garanzia; che si mantengano intatti tutti i riferimenti
            a questa Licenza e all'assenza di ogni garanzia; che si dia a ogni
            altro acquirente del Programma una copia di questa Licenza insieme
            al Programma. </p>
        <p align="justify">&egrave; possibile richiedere
            un pagamento per il trasferimento fisico di una copia del Programma, &egrave; anche
            possibile a propria discrezione richiedere un pagamento in cambio
            di una copertura assicurativa. </p>
        <p align="justify">2. &egrave; lecito modificare
            la propria copia o copie del Programma, o parte di esso, creando
            perci&ograve; un lavoro basato sul Programma, e copiare o distribuire
            queste modifiche e questi lavori secondo i termini del precedente
            comma 1, a patto che vengano soddisfatte queste condizioni: </p>
        <p align="justify">a) Bisogna indicare chiaramente
            nei file che si tratta di copie modificate e la data di ogni modifica. </p>
        <p align="justify">b) Bisogna fare in modo che
            ogni lavoro distribuito o pubblicato, che in parte o nella sua totalit&agrave; derivi
            dal Programma o da parti di esso, sia utilizzabile gratuitamente
            da terzi nella sua totalit&agrave;, secondo le condizioni di questa
            licenza. </p>
        <p align="justify">c) Se di solito il programma
            modificato legge comandi interattivamente quando viene eseguito,
            bisogna fare in modo che all'inizio dell'esecuzione interattiva usuale,
            stampi un messaggio contenente un'appropriata nota di diritto d'autore
            e di assenza di garanzia (oppure che specifichi che si offre una
            garanzia). Il messaggio deve inoltre specificare agli utenti che
            possono ridistribuire il programma alle condizioni qui descritte
            e deve indicare come consultare una copia di questa licenza. Se per&ograve; il
            programma di partenza &egrave; interattivo ma normalmente non stampa
            tale messaggio, non occorre che un lavoro derivato lo stampi. </p>
        <p align="justify">Questi requisiti si applicano
            al lavoro modificato nel suo complesso. Se sussistono parti identificabili
            del lavoro modificato che non siano derivate dal Programma e che
            possono essere ragionevolmente considerate lavori indipendenti, allora
            questa Licenza e i suoi termini non si applicano a queste parti quando
            vengono distribuite separatamente. Se per&ograve; queste parti vengono
            distribuite all'interno di un prodotto che &egrave; un lavoro basato
            sul Programma, la distribuzione di questo prodotto nel suo complesso
            deve avvenire nei termini di questa Licenza, le cui norme nei confronti
            di altri utenti si estendono a tutto il prodotto, e quindi a ogni
            sua parte, chiunque ne sia l'autore. </p>
        <p align="justify">Sia chiaro che non &egrave; nelle
            intenzioni di questa sezione accampare diritti su lavori scritti
            interamente da altri, l'intento &egrave; piuttosto quello di esercitare
            il diritto di controllare la distribuzione di lavori derivati o dal
            Programma o di cui esso sia parte. </p>
        <p align="justify">Inoltre, se il Programma o un
            lavoro derivato da esso viene aggregato a un altro lavoro non derivato
            dal Programma su di un mezzo di memorizzazione o di distribuzione,
            il lavoro non derivato non ricade nei termini di questa licenza. </p>
        <p align="justify">3. &egrave; lecito copiare e
            distribuire il Programma (o un lavoro basato su di esso, come espresso
            al comma 2) sotto forma di codice oggetto o eseguibile secondo i
            termini dei precedenti commi 1 e 2, a patto che si applichi una delle
            seguenti condizioni: </p>
        <p align="justify">a) Il Programma sia corredato
            dal codice sorgente completo, in una forma leggibile dal calcolatore
            e tale sorgente deve essere fornito secondo le regole dei precedenti
            commi 1 e 2 su di un mezzo comunemente usato per lo scambio di programmi. </p>
        <p align="justify">b) Il Programma sia accompagnato
            da un'offerta scritta, valida per almeno tre anni, di fornire a chiunque
            ne faccia richiesta una copia completa del codice sorgente, in una
            forma leggibile dal calcolatore, in cambio di un compenso non superiore
            al costo del trasferimento fisico di tale copia, che deve essere
            fornita secondo le regole dei precedenti commi 1 e 2 su di un mezzo
            comunemente usato per lo scambio di programmi. </p>
        <p align="justify">c) Il Programma sia accompagnato
            dalle informazioni che sono state ricevute riguardo alla possibilit&agrave; di
            ottenere il codice sorgente. Questa alternativa &egrave; permessa
            solo in caso di distribuzioni non commerciali e solo se il programma &egrave; stato
            ricevuto sotto forma di codice oggetto o eseguibile in accordo al
            precedente punto b). </p>
        <p align="justify">Per codice sorgente completo
            di un lavoro si intende la forma preferenziale usata per modificare
            un lavoro. Per un programma eseguibile, codice sorgente completo
            significa tutto il codice sorgente di tutti i moduli in esso contenuti,
            pi&ugrave; ogni file associato che definisca le interfacce esterne
            del programma, pi&ugrave; gli script usati per controllare la compilazione
            e l'installazione dell'eseguibile. In ogni caso non &egrave; necessario
            che il codice sorgente fornito includa nulla che sia normalmente
            distribuito (in forma sorgente o in formato binario) con i principali
            componenti del sistema operativo sotto cui viene eseguito il Programma
            (compilatore, kernel, e cos&igrave; via), a meno che tali componenti
            accompagnino l'eseguibile. </p>
        <p align="justify">Se la distribuzione dell'eseguibile
            o del codice oggetto &egrave; effettuata indicando un luogo dal quale
            sia possibile copiarlo, permettere la copia del codice sorgente dallo
            stesso luogo &egrave; considerata una valida forma di distribuzione
            del codice sorgente, anche se copiare il sorgente &egrave; facoltativo
            per l'acquirente. </p>
        <p align="justify">4. Non &egrave; lecito copiare,
            modificare, sublicenziare, o distribuire il Programma in modi diversi
            da quelli espressamente previsti da questa Licenza. Ogni tentativo
            contrario di copiare, modificare, sublicenziare o distribuire il
            Programma &egrave; legalmente nullo, e far&agrave; cessare automaticamente
            i diritti garantiti da questa Licenza. D'altra parte ogni acquirente
            che abbia ricevuto copie, o diritti, coperti da questa Licenza da
            parte di persone che violano la Licenza come qui indicato non vedranno
            invalidare la loro Licenza, purch&eacute; si comportino conformemente
            a essa. </p>
        <p align="justify">5. L'acquirente non &egrave; obbligato
            ad accettare questa Licenza, poich&eacute; non l'ha firmata. D'altra
            parte nessun altro documento garantisce il permesso di modificare
            o distribuire il Programma o i lavori derivati da esso. Queste azioni
            sono proibite dalla legge per chi non accetta questa Licenza; perci&ograve;,
            modificando o distribuendo il Programma o un lavoro basato sul programma,
            si accetta implicitamente questa Licenza e quindi di tutti i suoi
            termini e le condizioni poste sulla copia, la distribuzione e la
            modifica del Programma o di lavori basati su di esso. </p>
        <p align="justify">6. Ogni volta che il Programma
            o un lavoro basato su di esso vengono distribuiti, l'acquirente riceve
            automaticamente una licenza d'uso da parte del licenziatario originale.
            Tale licenza regola la copia, la distribuzione e la modifica del
            Programma secondo questi termini e queste condizioni. Non &egrave; lecito
            imporre restrizioni ulteriori all'acquirente nel suo esercizio dei
            diritti qui garantiti. Chi distribuisce programmi coperti da questa
            Licenza non &egrave; comunque responsabile per la conformit&agrave; alla
            Licenza da parte di terzi. </p>
        <p align="justify">7. Se, come conseguenza del
            giudizio di un tribunale, o di un'imputazione per la violazione di
            un brevetto o per ogni altra ragione (anche non relativa a questioni
            di brevetti), vengono imposte condizioni che contraddicono le condizioni
            di questa licenza, che queste condizioni siano dettate dal tribunale,
            da accordi tra le parti o altro, queste condizioni non esimono nessuno
            dall'osservazione di questa Licenza. Se non &egrave; possibile distribuire
            un prodotto in un modo che soddisfi simultaneamente gli obblighi
            dettati da questa Licenza e altri obblighi pertinenti, il prodotto
            non pu&ograve; essere distribuito affatto. Per esempio, se un brevetto
            non permettesse a tutti quelli che lo ricevono di ridistribuire il
            Programma senza obbligare al pagamento di diritti, allora l'unico
            modo per soddisfare contemporaneamente il brevetto e questa Licenza &egrave; di
            non distribuire affatto il Programma. </p>
        <p align="justify">Se parti di questo comma sono
            ritenute non valide o inapplicabili per qualsiasi circostanza, deve
            comunque essere applicata l'idea espressa da questo comma; in ogni
            altra circostanza invece deve essere applicato il comma 7 nel suo
            complesso. </p>
        <p align="justify">Non &egrave; nello scopo di
            questo comma indurre gli utenti a violare alcun brevetto n&eacute; ogni
            altra rivendicazione di diritti di propriet&agrave;, n&eacute; di
            contestare la validit&agrave; di alcuna di queste rivendicazioni;
            lo scopo di questo comma &egrave; solo quello di proteggere l'integrit&agrave; del
            sistema di distribuzione del software libero, che viene realizzato
            tramite l'uso della licenza pubblica. Molte persone hanno contribuito
            generosamente alla vasta gamma di programmi distribuiti attraverso
            questo sistema, basandosi sull'applicazione consistente di tale sistema.
            L'autore/donatore pu&ograve; decidere di sua volont&agrave; se preferisce
            distribuire il software avvalendosi di altri sistemi, e l'acquirente
            non pu&ograve; imporre la scelta del sistema di distribuzione. </p>
        <p align="justify">Questo comma serve a rendere
            il pi&ugrave; chiaro possibile ci&ograve; che crediamo sia una conseguenza
            del resto di questa Licenza. </p>
        <p align="justify">8. Se in alcuni paesi la distribuzione
            e/o l'uso del Programma sono limitati da brevetto o dall'uso di interfacce
            coperte da diritti d'autore, il detentore del copyright originale
            che pone il Programma sotto questa Licenza pu&ograve; aggiungere
            limiti geografici espliciti alla distribuzione, per escludere questi
            paesi dalla distribuzione stessa, in modo che il programma possa
            essere distribuito solo nei paesi non esclusi da questa regola. In
            questo caso i limiti geografici sono inclusi in questa Licenza e
            ne fanno parte a tutti gli effetti. </p>
        <p align="justify">9. All'occorrenza la Free Software
            Foundation pu&ograve; pubblicare revisioni o nuove versioni di questa
            Licenza Pubblica Generica. Tali nuove versioni saranno simili a questa
            nello spirito, ma potranno differire nei dettagli al fine di coprire
            nuovi problemi e nuove situazioni. </p>
        <p align="justify">Ad ogni versione viene dato
            un numero identificativo. Se il Programma asserisce di essere coperto
            da una particolare versione di questa Licenza e da ogni versione
            successiva, l'acquirente pu&ograve; scegliere se seguire le condizioni
            della versione specificata o di una successiva. Se il Programma non
            specifica quale versione di questa Licenza deve applicarsi, l'acquirente
            pu&ograve; scegliere una qualsiasi versione tra quelle pubblicate
            dalla Free Software Foundation. </p>
        <p align="justify">10. Se si desidera incorporare
            parti del Programma in altri programmi liberi le cui condizioni di
            distribuzione differiscano da queste, &egrave; possibile scrivere
            all'autore del Programma per chiederne l'autorizzazione. Per il software
            il cui copyright &egrave; detenuto dalla Free Software Foundation,
            si scriva alla Free Software Foundation; talvolta facciamo eccezioni
            alle regole di questa Licenza. La nostra decisione sar&agrave; guidata
            da due scopi: preservare la libert&agrave; di tutti i prodotti derivati
            dal nostro software libero e promuovere la condivisione e il riutilizzo
            del software in generale. </p>
        <p align="justify"><strong>NESSUNA GARANZIA </strong></p>
        <p align="justify">11. POICH&eacute; IL PROGRAMMA &egrave; CONCESSO
            IN USO GRATUITAMENTE, NON C'&egrave; ALCUNA GARANZIA PER IL PROGRAMMA,
            NEI LIMITI PERMESSI DALLE VIGENTI LEGGI. SE NON INDICATO DIVERSAMENTE
            PER ISCRITTO, IL DETENTORE DEL COPYRIGHT E LE ALTRE PARTI FORNISCONO
            IL PROGRAMMA "COSI` COM'&egrave;", SENZA ALCUN TIPO DI GARANZIA,
            N&eacute; ESPLICITA N&eacute; IMPLICITA; CI&ograve; COMPRENDE, SENZA
            LIMITARSI A QUESTO, LA GARANZIA IMPLICITA DI COMMERCIABILIT&agrave; E
            UTILIZZABILIT&agrave; PER UN PARTICOLARE SCOPO. L'INTERO RISCHIO
            CONCERNENTE LA QUALIT&agrave; E LE PRESTAZIONI DEL PROGRAMMA &egrave; DELL'ACQUIRENTE.
            SE IL PROGRAMMA DOVESSE RIVELARSI DIFETTOSO, L'ACQUIRENTE SI ASSUME
            IL COSTO DI OGNI MANUTENZIONE, RIPARAZIONE O CORREZIONE NECESSARIA. </p>
        <p align="justify">12. N&eacute; IL DETENTORE DEL
            COPYRIGHT N&eacute; ALTRE PARTI CHE POSSONO MODIFICARE O RIDISTRIBUIRE
            IL PROGRAMMA COME PERMESSO IN QUESTA LICENZA SONO RESPONSABILI PER
            DANNI NEI CONFRONTI DELL'ACQUIRENTE, A MENO CHE QUESTO NON SIA RICHIESTO
            DALLE LEGGI VIGENTI O APPAIA IN UN ACCORDO SCRITTO. SONO INCLUSI
            DANNI GENERICI, SPECIALI O INCIDENTALI, COME PURE I DANNI CHE CONSEGUONO
            DALL'USO O DALL'IMPOSSIBILIT&agrave; DI USARE IL PROGRAMMA; CI&ograve; COMPRENDE,
            SENZA LIMITARSI A QUESTO, LA PERDITA DI DATI, LA CORRUZIONE DEI DATI,
            LE PERDITE SOSTENUTE DALL'ACQUIRENTE O DA TERZE PARTI E L'INABILIT&agrave; DEL
            PROGRAMMA A LAVORARE INSIEME AD ALTRI PROGRAMMI, ANCHE SE IL DETENTORE
            O ALTRE PARTI SONO STATE AVVISATE DELLA POSSIBILIT&agrave; DI QUESTI
            DANNI. </p>
        <p align="justify"><strong>FINE DEI TERMINI E DELLE
              CONDIZIONI </strong></p>
        <p align="justify"><b>Appendice: come applicare questi
            termini ai nuovi programmi </b></p>
        <p align="justify">Se si sviluppa un nuovo programma
            e lo si vuole rendere della maggiore utilit&agrave; possibile per
            il pubblico, la cosa migliore da fare &egrave; fare s&igrave; che
            divenga software libero, cosicch&eacute; ciascuno possa ridistribuirlo
            e modificarlo secondo questi termini. </p>
        <p align="justify">Per fare questo, si inserisca
            nel programma la seguente nota. La cosa migliore da fare &egrave; mettere
            la nota all`inizio di ogni file sorgente, per chiarire nel modo pi&ugrave; efficace
            possibile l'assenza di garanzia; ogni file dovrebbe contenere almeno
            la nota di diritto d'autore e l'indicazione di dove trovare l'intera
            nota. </p>
        <div align="justify">
          <p><i>&lt;una riga per dire in breve
              il nome del programma e cosa fa&gt; Copyright (C) 19aa &lt;nome dell'autore&gt; Questo
              programma &egrave; software libero; &egrave; lecito ridistribuirlo
              e/o modificarlo secondo i termini della Licenza Pubblica Generica
              GNU come pubblicata dalla Free Software Foundation; o la versione
              2 della licenza o (a scelta) una versione successiva. Questo programma &egrave; distribuito
              nella speranza che sia utile, ma SENZA ALCUNA GARANZIA; senza neppure
              la garanzia implicita di COMMERCIABILIT&agrave; o di APPLICABILIT&agrave; PER
              UN PARTICOLARE SCOPO. Si veda la Licenza Pubblica Generica GNU per
              avere maggiori dettagli. Ognuno dovrebbe avere ricevuto una copia
              della Licenza Pubblica Generica GNU insieme a questo programma; in
              caso contrario, la si pu&ograve; ottenere dalla Free Software Foundation,
              Inc., 675 Mass Ave, Cambridge, MA 02139, Stati Uniti. </i></p>
        </div>
        <p align="justify">Si aggiungano anche informazioni
            su come si pu&ograve; essere contattati tramite posta elettronica
            e cartacea. </p>
        <p align="justify">Se il programma &egrave; interattivo,
            si faccia in modo che stampi una breve nota simile a questa quando
            viene usato interattivamente: <br />
            <i>Orcaloca versione 69, Copyright
              (C) 19aa &lt;nome dell'autore&gt; Orcaloca non ha ALCUNA GARANZIA;
              per i dettagli digitare `show g'. Questo &egrave; software libero,
              e ognuno &egrave; libero di ridistribuirlo sotto certe condizioni;
              digitare `show c' per dettagli. </i></p>
        <div align="justify"></div>
        <p align="justify">Gli ipotetici comandi "show
            g" e "show c" mostreranno le parti appropriate della Licenza Pubblica
            Generica. Chiaramente, i comandi usati possono essere chiamati diversamente
            da "show g" e "show c" e possono anche essere selezionati con il
            mouse o attraverso un men&ugrave;; in qualunque modo pertinente al
            programma. </p>
        <p align="justify">Se necessario, si dovrebbe anche
            far firmare al proprio datore di lavoro (se si lavora come programmatore)
            o alla propria scuola, se si &egrave; studente, una ?rinuncia ai
            diritti? per il programma. Ecco un esempio con nomi fittizi:<br />
            <i>Yoyodinamica
            SPA rinuncia con questo documento a ogni rivendicazione di diritti
            d'autore sul programma `Orcaloca' (che fa il primo passo con i compilatori)
            scritto da Giovanni Smanettone. &lt;firma di Primo Tizio&gt;, 1 Aprile
            1999 Primo Tizio, Presidente </i></p>
        <p align="justify">I programmi
            coperti da questa Licenza Pubblica Generica non possono essere incorporati
            all'interno di programmi non liberi. Se il proprio programma &egrave; una libreria
            di funzioni, pu&ograve; essere pi&ugrave; utile permettere di collegare
            applicazioni proprietarie alla libreria. In questo caso consigliamo
            di usare la Licenza Generica Pubblica GNU per Librerie (LGPL) al
            posto di questa Licenza. </p>
      <p align="justify">&nbsp;</p></td>
    </tr>
</table>
	<div id='addizionali'>&nbsp;</div>
	</div>
</div>
<?php
include("./footer.php");
?>