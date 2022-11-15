@section('title')
<title>{{ucfirst($settings['site_name'])}} :::Terms of use</title>
<meta  name="description" content="Terms of use">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Terms of use"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')

@section('sub')
 <div class="uk-width-1-1 in-breadcrumb">
                        <ul class="uk-breadcrumb uk-text-uppercase"><li><a href="{{url('/')}}">Home</a></li><li><a href="#"></a></li>
                          </ul>
                    </div>
@endsection
<main>
   <div class="uk-section uk-padding-large">
        <div class="uk-container in-wave-4">
            <div class="uk-grid uk-flex uk-flex-left">
             
                  <div class="uk-width-3-4@m">
                    <h1 class="uk-margin-remove-bottom">Terms and<span class="in-highlight"> Conditions</span></h1>
                </div>
                <br>  <br>                <br>  <br>

                           <p>
                The materials on this Site are provided by {{$settings['site_name']}} Corporation. (“{{$settings['site_name']}}”) as a service to its customers and partners and may be used for informational and non-commercial purposes only. The Terms and Conditions set forth below apply to all visitors to or users of this Site. By accessing this Site, using any Services provided on the Site or downloading any materials from this Site, you agree to be bound by these Terms and Conditions. If you do not agree to them, do not use the Site or download any materials from it.
            </p>
            <br>
            <h2>
                Limited License
            </h2>    <br>
            <p>
                {{$settings['site_name']}} hereby grants you a license under its and other applicable copyrights to download one copy of the information or software (“Materials”) found on the Site onto a single computer solely for your personal, non-commercial internal use in support of the use or marketing of {{$settings['site_name']}} products or, if you have a pre-existing business relationship with {{$settings['site_name']}}, you may download Materials for use in the furtherance of, and subject to the terms and conditions of, the provisions of your separate written agreement with {{$settings['site_name']}}. Additionally, some Materials may be made available only subject to certain additional license terms which may accompany or are provided with such Materials, and your download and use of those Materials will be subject to those additional terms and conditions. This is a license, not a transfer of title, and is subject to the following restrictions: you may not: modify the Materials or use them for any commercial purpose, or any public display, performance, sale or rental; decompile, reverse engineer, or disassemble Materials except and only to the extent permitted by applicable law; remove any copyright or other proprietary notices from the Materials; transfer the materials to another person. Further, you agree to prevent any unauthorized copying of the Materials and you agree that any copy of these materials which you make shall retain all copyright and other proprietary notices in the same form and manner as on the original.
            </p>
            <p>
                ALL CONTENTS ON THIS SITE, AND THE COMPILATION AND ARRANGEMENT OF THE CONTENTS, ARE PROTECTED BY COPYRIGHT AND, WHERE APPLICABLE, OTHER INTELLECTUAL PROPERTY RIGHTS. EXCEPT AS EXPRESSLY SPECIFIED ABOVE, NO PORTION OF THE INFORMATION ON THIS SITE MAY BE REPRODUCED, MODIFIED, PUBLISHED, UPLOADED, POSTED, TRANSMITTED, OR DISTRIBUTED IN ANY FORM, OR BY ANY MEANS, WITHOUT PRIOR WRITTEN PERMISSION FROM {{$settings['site_name']}}, AND NOTHING CONTAINED HEREIN SHALL BE CONSTRUED AS CONFERRING BY IMPLICATION, ESTOPPEL OR OTHERWISE ANY LICENSE OR RIGHT UNDER ANY PATENT, TRADEMARK OR COPYRIGHT OF {{$settings['site_name']}} OR ANY THIRD PARTY.
            </p>
            <br> <h2>
                Services
            </h2>    <br>
            <p>
                Any services provided on this Site (the “Services”) and information obtained through the Services (the “Data”) are the private property of {{$settings['site_name']}}. Without limitation, you are not authorized to make the Data available on any web site or otherwise reproduce, distribute, copy, store, use or sell the Data for any purpose without the express wrote consent of {{$settings['site_name']}}. The Services on this Site are designed for occasional use by individuals, and your right to use the Services or Data is non-assignable. Any access or use that is inconsistent with these terms is unauthorized and strictly prohibited.
            </p>
            <br>  <h2>
                Trademarks
            </h2>    <br>
            <p>
                The trademarks, logos and service marks (“Marks”) displayed on this Site are the property of {{$settings['site_name']}} or third parties. You are not permitted to use these Marks without the prior written consent of {{$settings['site_name']}} or such third party which may own the Mark.
            </p>
            <p>
                {{$settings['site_name']}} Corporation and the {{$settings['site_name']}} logo are trademarks or registered trademarks of {{$settings['site_name']}} Corporation, in the Estonia  and/or in other countries. All other brands, products, or service names are or may be trademarks or service marks of, and are used to identify, products or services of their respective owners.
            </p>
            <br> <h2>
                User Submissions
            </h2>    <br>
            <p>
                Any comments, information or other materials of any kind whatsoever posted to this Site or transmitted to {{$settings['site_name']}} such as questions, comments, suggestions, or the like regarding {{$settings['site_name']}} products or programs, this Site and the Materials and other information discussed on this Site (“Feedback”) will be considered non-confidential and non-proprietary unless expressly agreed otherwise in writing by {{$settings['site_name']}} before to your submission. {{$settings['site_name']}} shall have no obligations to you concerning its use or disclosure of such Feedback, and {{$settings['site_name']}} shall have a worldwide, perpetual, irrevocable and fully-paid right to use, reproduce, prepare derivative works of, perform, display and distribute the Feedback, including any ideas, concepts, know-how or techniques contained in such Feedback, for any purposes without limitation, and to authorize others to do so as well. You are prohibited from posting or transmitting to or from this Site any unlawful, threatening, libelous, defamatory, obscene, pornographic, or other material that would violate any law. {{$settings['site_name']}} may, in its sole discretion, remove or delete any Feedback, for any reason, without prior notice.
            </p>
            <br> <h2>
                General Disclaimer
            </h2>    <br>
            <p>
                Although {{$settings['site_name']}} has attempted to provide accurate information on the Site, {{$settings['site_name']}} assumes no responsibility for the accuracy of any such information. ALL INFORMATION, SERVICES, DATA AND OTHER MATERIALS PROVIDED ON THIS SITE ARE PROVIDED “AS IS” WITHOUT WARRANTY OF ANY KIND, EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING WITHOUT LIMITATION ANY WARRANTY OF MERCHANTABILITY, NONINFRINGEMENT OR FITNESS FOR ANY PARTICULAR PURPOSE. ADDITIONALLY, IN NO EVENT SHALL {{$settings['site_name']}} OR ITS SUPPLIERS BE LIABLE FOR ANY DAMAGES WHATSOEVER (INCLUDING WITHOUT LIMITATION ANY LOST PROFITS, LOST DATA, LOSS OF USE OR COSTS OF PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES) INCLUDING WITHOUT LIMITATION ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL DAMAGES ARISING IN ANY WAY OUT OF THE USE OF OR INABILITY TO USE OR ACCESS THE SITE, SERVICES OR MATERIALS, UNDER ANY CAUSE OF ACTION OR THEORY OF LIABILITY, AND IRRESPECTIVE OF WHETHER SUCH PARTY HAD ADVANCE NOTICE OF THE POSSIBILITY OF SUCH DAMAGES.
            </p>
            <p>
                {{$settings['site_name']}} and its suppliers further do not warrant the accuracy or completeness of the information, text, graphics, links or other items contained within the Site or the Materials. Palo Alto Networks may make changes to the Site, Services or Materials, or to the products described therein, at any time without notice. Palo Alto Networks does not commit to update the Materials. Mention of non-Palo Alto Networks products or services is for information purposes only and constitutes neither an endorsement nor a recommendation.
            </p>
            <br> <h2>
                Links to Third-Party Sites
            </h2>    <br>
            <p>
                This Site may contain links to third-party sites. {{$settings['site_name']}} provides these links merely as a convenience to you, and the inclusion of such links in no way implies an endorsement of the linked site or the products and services referenced on that site. The linked sites are not under the control of {{$settings['site_name']}}, and {{$settings['site_name']}} is not responsible for the accuracy or reliability of any information, opinions, advice or statements made on these linked sites. Access to any of these linked sites is at the user’s own risk. Access to Password Protected/Secure Areas
            </p>
            <p>
                Access to and use of password-protected and/or secure areas of the Site is restricted to authorized users only. Unauthorized individuals attempting to access these areas of the Site may be subject to prosecution.
            </p>
            <br> <h2>
                Government Use
            </h2>    <br>
            <p>
                {{$settings['site_name']}} products and publications are commercial. Use, duplication or disclosure by the Estonia Government is subject to Estonia restrictions outlined in commercial software law.
            </p>
            <br> <h2>
                Applicable Law
            </h2>    <br>
            <p>
                This site is controlled by {{$settings['site_name']}} from its offices within the Estonia. {{$settings['site_name']}} makes no representation that Materials or Services in the Site are appropriate or available for use in other locations, and access to them from territories where their content is illegal is prohibited. Those who choose to access this Site from other locations do so on their initiative and are responsible for compliance with applicable local laws. You may not use or export the Materials in violation of Estonia export laws and regulations. Not all products or programs mentioned may be available in your country. Please contact your local sales representative for information as to products and services available in your country.
            </p>
            <br> <h2>
                Termination
            </h2>    <br>
            <p>
                {{$settings['site_name']}} shall have the right to terminate the license granted to you to use, interact with, download and use the Site, Services, and Materials available from this Site at any time if you are found to be in breach any of these terms and conditions, or for any other reason. Upon termination, you agree to immediately destroy any Materials in your possession or control.
            </p>
            <br> <h2>
                General
            </h2>    <br>
            <p>
                {{$settings['site_name']}} reserves the right to change these terms and conditions at any time without notice by altering or updating this posting. Some of the Services or Materials available on this Site (e.g., software downloadable from this Site) may be superseded by expressly designated legal notices or terms located on particular pages at this Site. These Terms and Conditions, including any claim relating to the Services or Materials, shall be governed by the internal substantive laws Estonia.
            </p>

            <p>
                Further, By accessing and using the Site of {{$settings['site_name']}} you agree to be bound by the terms and conditions of use contained herein (these “Terms of Use”). This Site contains general information about {{$settings['site_name']}}, {{$settings['site_name']}}, and their respective parents and subsidiaries (a platform of companies known as “{{$settings['site_name']}} ,” “we,” “us,” or “our,” and each such affiliate of {{$settings['site_name']}}, a third party beneficiary hereunder), our business, our history and predecessor entities, and our portfolio, and is directed at our customers and potential customers, and for individuals considering possible employment with {{$settings['site_name']}}.  These Terms of Use are a binding agreement between you and {{$settings['site_name']}}, and govern your access and use of the Site, including, without limitation, any information, text, software, photos, video, graphics, audio, data, tools, products, services, documents, links, advertisements, policies, functions, materials, and other content (collectively, the “Content”) available on the Site.
            </p>
            <p>
                PLEASE READ THESE TERMS OF USE CAREFULLY BEFORE ENTERING THE SITE. EACH TIME YOU ENTER THE SITE, YOU ARE AGREEING TO FULLY ACCEPT AND AGREE TO ABIDE BY THESE TERMS OF USE. IF YOU DO NOT AGREE WITH THESE TERMS OF USE, EXIT THE SITE AND DO NOT ACCESS, REQUEST, OR DOWNLOAD PORTION OF THE CONTENT.
            </p>
            <p>
                YOU ACKNOWLEDGE AND AGREE THAT {{$settings['site_name']}} MAY, IN ITS SOLE DISCRETION AND WITHOUT ADVANCE NOTICE, UPDATE OR OTHERWISE MODIFY THE SITE AND THE CONTENT, AND MAY MODIFY THESE TERMS OF USE AT ANY TIME. MODIFICATIONS WILL BE EFFECTIVE IMMEDIATELY UPON POSTING UNLESS WE INDICATE OTHERWISE. YOU AGREE TO PERIODICALLY REVIEW THESE TERMS AND USE. THE DATE OF THE LAST REVISION OR UPDATE APPEARS AT THE TOP OF THE AGREEMENT. EACH TIME YOU ENTER THE SITE, YOU AGREE TO AND FULLY ACCEPT THESE TERMS OF USE IN ITS THEN CURRENT FORM. YOUR CONTINUED USE OF THE SITE WILL INDICATE ACCEPTANCE BY YOU OF SUCH RULES, CHANGES OR MODIFICATIONS.
            </p>
            <br> <h2>
                INTELLECTUAL PROPERTY RIGHTS AND OWNERSHIP
            </h2>    <br>
            <p>
                The Site and all of the Content, code, software, data and other materials thereon, the look and feel of the Site, and the design and organization of the Site, and the {{$settings['site_name']}} name and logo, and all related product and service names, design marks and slogans are the service marks, trademarks or registered service marks or trademarks (the “Marks”) are owned by or licensed to {{$settings['site_name']}}, subject to copyright and other intellectual property rights under Estonia  and foreign laws and international conventions. The Site is provided by {{$settings['site_name']}} for informational purposes, as a service to {{$settings['site_name']}}’s customers and potential customers, and for individuals considering possible employment with {{$settings['site_name']}}.
            </p>
            <p>
                You may not use any {{$settings['site_name']}} or third party trademarks or logos without the prior written consent of {{$settings['site_name']}} or the applicable trademark owner. Nothing contained on the site should be construed as granting, by implication, estoppel or otherwise, any license or right to use any Content without the written permission of {{$settings['site_name']}} or such other party that may own any Content, the Marks, or other trademarks.
            </p>
            <p>
                You shall not upload, post or otherwise make available on the Site any information and material protected by copyright, trademark or other proprietary right without the express written permission of the owner of such right(s). You shall be solely liable for any damages resulting from any infringement of copyright, proprietary rights, or any other harm resulting from such a submission.
            </p>
            <p>
                The Site contains content that is derived in whole or in part from information and materials supplied by {{$settings['site_name']}} and other sources. You are prohibited from removing any copyright, trademark or other proprietary notice or legend contained on (or printed from) the Site or on any printed pages. Use of the Site is not a transfer of title in the Content and by your use of the Site, you acknowledge that you do not acquire any ownership or other rights to the Content, except that you are hereby granted a non-exclusive license to use the Content, but only while accessing this Site.
            </p>
            <br> <h2>
                RESTRICTIONS ON USE OF THE SITE
            </h2>    <br>
            <p>
                You agree to not engage in the use, copying, or distribution of any of the Content, including any use, copying, or distribution of third parties’ materials obtained through the Site, provided you are granted a limited license to print copies of any Content, but only for personal, non-commercial use. At any time and for any reason, {{$settings['site_name']}} may revoke your right to use all or any portion of the Site.
            </p>
            <br><h2>
                SITE SECURITY
            </h2>    <br>
            <p>
                While accessing or using any portions of the Site, you agree that neither you nor your agents shall do any of the following, including, without limitation, violating or attempting to violate the security of the Site:
            </p>
            <ul>
                <li>
                    tamper with any portion of the Site;
                </li>
                <li>
                    impersonate any person or entity or misrepresent your affiliation with any other person or entity;
                </li>
                <li>
                    conduct fraudulent activities on the Site;
                </li>
                <li>
                    obtain or attempt to gain unauthorized access to other computer systems, materials, information or any services available on or through the Site through any means, including through the use of meta tags or other hidden text or by other means not intentionally made publicly available or provided for through the Site;
                </li>
                <li>
                    engage in “spidering,” “screen scraping,” “database scraping,” mining or harvesting of e-mail addresses or other personal information, or any other automatic or unauthorized means of accessing, logging-in or registering on any of the Site, or obtaining lists of users or other information from or through the Site, including, without limitation, any information residing on any server or database connected to the Site;
                </li>
                <li>
                    interrupt, damage, disable, overburden or impair the Site or interfere with any other party’s use and enjoyment of the Site, such as sending mass unsolicited messages or “flooding” servers with requests;
                </li>
                <li>
                    circumvent, reverse engineer, decrypt, or otherwise alter or interfere with (or attempt, encourage or support anyone else’s attempt to do any of the foregoing) the Site or its services or any software on the Site;
                </li>
                <li>
                    attempt to probe, scan, or test the vulnerability of the Site or to breach the security or authentication measures without proper authorization;
                </li>
                <li>
                    violate, plagiarize or infringe the rights of third parties, including without limitation, copyright, trademark, trade secret, confidentiality, contract, patent, rights of privacy or rights of publicity or any other proprietary or legal right;
                </li>
                <li>
                    remove any notices, warnings, labels, annotations, or instructions from any portion of the Site, including, without limitation, any patent, trademark, copyright, or other proprietary notices or license provisions; or
                </li>
                <li>
                    submit any information to the Site, in violation of any applicable law, rule or regulation.
                </li>
            </ul>
            <p>
                Any violations of these Terms of Use, the Site, system, or network security, including attempts to intentionally access a computer without authorization or exceed your authorized access level, may result in civil and criminal charges. {{$settings['site_name']}} may investigate occurrences that might involve such violations and may involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations. {{$settings['site_name']}} may, without prior notice or warning of any kind, restrict or terminate the access of any and all users at any time and for any reason, to all or any portion of the Site if {{$settings['site_name']}} concludes in its sole discretion that such restriction or termination is necessary to prevent, or prevent the further spread of, a virus, security breach, or system malfunction.
            </p>
            <br>  <h2>
                DISCLAIMERS
            </h2>    <br>
            <p>
                When reviewing the Content on the Site, there are various risks you assume. You agree that {{$settings['site_name']}}  is not liable for any action you take or decision you make in reliance on any of the Content on the Site.
            </p>
            <br> <h2>
                FORWARD LOOKING STATEMENTS:
            </h2>    <br>
            <p>
                The Content provided on the Site is for informational purposes only. Any estimates, projections, or predictions on the Site are intended to be forward-looking statements. Although {{$settings['site_name']}} believes that the expectations in such forward-looking statements are reasonable, it can give no assurance that any forward-looking statements will prove to be correct. Such estimates are subject to actual known and unknown risks, uncertainties and other factors that could cause actual results to differ materially from those projected. {{$settings['site_name']}} expressly disclaims any obligation or undertaking to update or revise any forward-looking statement contained herein to reflect any change in its expectations or any change in circumstances upon which such statement is based. No statements contained on the Site should be construed as a guarantee or assurance of future performance or future results. {{$settings['site_name']}} ’ past performance is not indicative of future results.
            </p>
            <br> <h2>
                NO OFFER OF SECURITIES OR ADVICE:
            </h2>    <br>
            <p>
                No information found on the Site constitutes an offering of advisory services or any securities. In the case that an offering of securities is made in accordance with the terms of a private offering memorandum or as otherwise permitted under the law, such offering may be limited to investors who are accredited investors, knowledgeable employees, and in some cases, offerings of securities will only be made to the extent certain investors are also qualified purchasers. Any offer or solicitation with respect to any securities that may be issued by any investment vehicle managed by {{$settings['site_name']}}  will be made only by means of definitive offering memoranda and in accordance with the relevant securities and other laws of applicable jurisdictions. Nothing on the Site is intended to be, and you should not consider anything on the Site to be, investment, accounting, tax or legal advice. You are encouraged to discuss information that you learn from the Site with your financial, legal or tax advisors where applicable.
            </p>
            <br>  <h2>
                CONTENT DISCLAIMERS:
            </h2>    <br>
            <p>
                We make reasonable efforts to ensure accuracy with respect to the Content, but at times we may not promptly update or correct the Site even if we are aware that it is inaccurate, outdated or otherwise inappropriate. Dated information speaks only as of the date indicated. {{$settings['site_name']}}  does not warrant or guaranty the accuracy or completeness of the information made available on the Site. In addition, we do not endorse the opinions of, or warrant the accuracy of facts or other content contributed by, any third party.
            </p>
            <br>  <h2>
                DISCLAIMER OF WARRANTY:
            </h2>    <br>
            <p>
                THE SITE AND THE CONTENT IS PROVIDED “AS IS” AND “AS AVAILABLE,” FOR YOUR INFORMATION AND PERSONAL NON-COMMERCIAL USE ONLY AND MAY NOT BE USED, COPIED, REPRODUCED, DISTRIBUTED, TRANSMITTED, BROADCAST, DISPLAYED, SOLD, LICENSED, OR OTHERWISE EXPLOITED FOR ANY OTHER PURPOSES WHATSOEVER WITHOUT THE PRIOR WRITTEN CONSENT OF {{$settings['site_name']}}. ALL USE OF THE SITE IS AT YOUR OWN RISK. {{$settings['site_name']}}  DISCLAIMS ALL REPRESENTATIONS AND WARRANTIES, EXPRESS OR IMPLIED, OF ANY KIND WITH RESPECT TO THE SITE INCLUDING WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT OF INTELLECTUAL PROPERTY AND PROPRIETARY RIGHTS. THIS DISCLAIMER WILL APPLY TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW.
            </p>
            <p>
                WITHOUT IN ANY WAY LIMITING ANY OTHER PROVISION HEREIN, WE DO NOT WARRANT THE AVAILABILITY, ACCURACY, COMPLETENESS, TIMELINESS, FUNCTIONALITY, RELIABILITY, SEQUENCING OR SPEED OF DELIVERY OF THE SITE OR ANY PART OF THE CONTENT CONTAINED WITHIN OR PRESENTED BY THE SITE.
            </p>
            <p>
                {{$settings['site_name']}} ASSUMES NO RESPONSIBILITY, AND SHALL NOT BE LIABLE FOR ANY DAMAGES RELATED TO VIRUSES, WORMS OR OTHER MALWARE THAT MAY INFECT YOUR COMPUTER EQUIPMENT OR OTHER PROPERTY ON ACCOUNT OF YOUR ACCESS TO, USE OF, OR BROWSING IN THE SITE (INCLUDING ANY BLOGS TO THE EXTENT THEY EXIST) OR YOUR DOWNLOADING OF ANY MATERIALS OR THE CONTENT FROM THE SITE.
            </p>
            <p>
                {{$settings['site_name']}}’S LIABILITY WITH RESPECT TO THE SITE IS LIMITED TO THE MAXIMUM EXTENT PERMITTED BY LAW.
            </p>

            <br> <h2>PRIVACY POLICY</h2>    <br>
            <p>It has been and remains {{$settings['site_name']}} ’ policy not to accept or consider ideas, suggestions or materials other than those that {{$settings['site_name']}}  has specifically requested from you. Accordingly, {{$settings['site_name']}}  does not want you to, and you should not, send any confidential or proprietary information to {{$settings['site_name']}}  through the Site unless specifically requested by {{$settings['site_name']}} . Please note that any unsolicited information or material sent to {{$settings['site_name']}}  will be deemed not to be confidential or proprietary. By submitting information and material to the Site, you agree that such information and material becomes the sole and exclusive property of {{$settings['site_name']}} and may be used by {{$settings['site_name']}}  for any lawful purpose without restriction, subject to this Privacy Policy. Conversely, if title may not lawfully be transferred in this manner, you automatically grant to {{$settings['site_name']}} (or warrant that the owner of such information and material has expressly granted to {{$settings['site_name']}}) a royalty-free, perpetual, irrevocable, unrestricted, right and license to use, reproduce, display, perform, modify, adapt, publish, translate, transmit and distribute, or otherwise make available to other such information and material (in whole or in part and for any purpose) worldwide and/or to incorporate it in other works in any form, media, or technology now known or hereafter developed. You also agree that {{$settings['site_name']}} is free to use any ideas, concepts, know-how, or techniques that you send to {{$settings['site_name']}} for any purpose.</p>
            <p>As further provided above, {{$settings['site_name']}} does not want to receive, and you are deemed to covenant and agree through the use of the Site not to provide, any information or materials to {{$settings['site_name']}} that are defamatory, threatening, obscene, harassing, in violation of any law, governmental requirements or otherwise unlawful, or that incorporate the proprietary information or materials of another person or entity.</p>
            <p>There are times, however, when we may need information from you, such as your name, email address or phone number. Customarily, the personal information {{$settings['site_name']}} obtains is used to respond to inquiries or provide information or materials to you from time to time. {{$settings['site_name']}}  also may use your personal information to discuss or offer our products or services. Occasionally, we may make the e-mail addresses of those who provide information available to our affiliates and to other reputable organizations whose products or services we think you may find interesting.</p>
            <p>{{$settings['site_name']}} may monitor and record user information and activity on the Site and respond as we deem appropriate. The use of this information may assist us in determining what is most beneficial for our users and allow us to better enhance the Consent and the Site.</p>
            <br> <h2>THIRD PARTY LINKS</h2>    <br>
            <p>While {{$settings['site_name']}} tries to link only to sites that share its high standards and respect for privacy, {{$settings['site_name']}} is not responsible for information on any third party website that may be referenced in, or accessible or connected by hyperlink to, the Site. If you access any third party website through the Site or otherwise, you do so at your own risk. {{$settings['site_name']}}  makes no warranty or representation regarding, and does not sponsor or endorse, any linked websites or the information or materials appearing thereon or any of products and services described thereon. Furthermore, links do not imply that {{$settings['site_name']}}  is affiliated or associated with, or that any linked site is authorized to use any service mark, trademark, trade name, logo, or copyright of {{$settings['site_name']}}.</p>
            <br>  <h2>LIMITATION OF LIABILITY</h2>    <br>
            <p>If you are dissatisfied with any of the Content contained in the Site, or with any of these Terms of Use, your sole and exclusive remedy is to discontinue accessing and using the Site.</p>
            <p>UNDER NO CIRCUMSTANCES SHALL {{$settings['site_name']}}  OR ANY OF ITS RESPECTIVE OFFICERS, DIRECTORS, AFFILIATES, PARTNERS, MEMBERS, PRINCIPALS, AGENTS, INVESTORS OR EMPLOYEES BE LIABLE FOR ANY CLAIMS, LIABILITIES, LOSSES, COSTS OR DAMAGES, INCLUDING DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL OR CONSEQUENTIAL DAMAGES WHATSOEVER (INCLUDING WITHOUT LIMITATION, COSTS AND EXPENSES OF ANY TYPE INCURRED, LOST PROFITS, LOST DATA OR PROGRAMS, AND BUSINESS INTERRUPTION), ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE USE, INABILITY TO USE OR THE RESULTS OF USE OF THE SITE, ANY WEBSITES LINKED TO THE SITE, OR ANY MATERIALS CONTAINED AT ANY OR ALL SUCH WEBSITES (INCLUDING BUT NOT LIMITED TO THOSE CAUSED BY OR RESULTING FROM A FAILURE OF PERFORMANCE; ERROR; OMISSION; LINKING TO OTHER WEBSITES; INTERRUPTION; DELETION; DEFECT; DELAY IN OPERATION OR TRANSMISSION; COMPUTER VIRUS; COMMUNICATION LINE FAILURE; OR DESTRUCTION, UNAUTHORIZED ACCESS TO, ALTERATION OF, OR USE OF ANY COMPUTER OR SYSTEM), ANY DELAY OR TECHNICAL PROBLEMS IN USING THE SITE, OR ANY INFORMATION AND THE CONTENT OBTAINED THROUGH THE SITE, OR OTHERWISE ARISING OUT OF THE USE OF THE SITE; IN ANY CASE WHETHER BASED ON THEORIES ARISING IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE. SUCH LIMITATIONS APPLY EVEN IF {{$settings['site_name']}}  OR ANY OF ITS RESPECTIVE OFFICERS, DIRECTORS, AFFILIATES, PARTNERS, MEMBERS, PRINCIPALS, AGENTS, INVESTORS OR EMPLOYEES HAVE BEEN ADVISED OF THE POSSIBILITY OF DAMAGES.</p>
            <br> <h2>INDEMNIFICATION</h2>    <br>
            <p>As a condition to your use of the Site, you agree to indemnify, defend and hold harmless {{$settings['site_name']}} and its respective, officers, directors, affiliates, partners, members, principals, agents, investors, employees, and third party sources from and against any and all suits, losses, claims, demands, liabilities, damages, costs and expenses (including reasonable attorneys’ fees) that arise from or relate to: (i) your use of the Site; (ii) your breach of these Terms of Use or any representation, warranty or covenant made by you in these Terms of Use; (iii) your violation of any applicable law, statute, ordinance, regulation or of any third party’s rights; or (iv) claims asserted by third parties which, if proven, would place you in breach of representations, warranties, covenants or other provisions contained in these Terms of Use.</p>
            <br> <h2>COMPLETE AGREEMENT</h2>    <br>
            <p>These Terms of Use constitute the entire agreement between you and {{$settings['site_name']}} relating to your use of the Site and the Content, and supersede any prior agreements or understandings not incorporated herein. Certain restricted areas of the Site may require you to agree to supplemental terms and conditions. These Terms of Use are not intended to modify or amend other agreements you may have with {{$settings['site_name']}}  regarding other matters.</p>
            <br><h2>SEVERABILITY AND WAIVER</h2>    <br>
            <p>If any provision of these Terms of Use is found to be invalid, void, or for any reason unenforceable in any jurisdiction, such provision shall be deemed modified to the minimum extent necessary so that such provision shall no longer be held to be invalid or unenforceable, and these Terms of Use shall be interpreted so as to achieve the intent expressed herein to the greatest extent possible in the jurisdiction in question. Any such modification, invalidity or unenforceability shall be strictly limited both to such provision. If it is not possible to construe the provision in question in such a manner that would make the provision valid and enforceable, then only the term or portion of the provision that renders the provision unenforceable will be stricken without affecting the enforceability of the remaining provisions of these Terms of Use. Any failure of {{$settings['site_name']}} to act on or enforce any provision of these Terms of Use shall not be construed as a waiver of that provision or any other provision of these Terms of Use.</p>
            <br> <h2>GOVERNING LAW AND VENUE</h2>    <br>
            <p>These Terms of Use shall be governed by and construed under the internal laws of the State of Illinois, without regard to its choice of law rules. Any legal claim or action brought hereunder shall be brought exclusively in Estonia courts located in Estonia, and you further agree and submit to the exercise of personal jurisdiction of such courts for the purpose of litigating any such claim or action.</p>
            <br> <h2>CONTACT</h2>    <br>
            <p>You may contact {{$settings['site_name']}} at <a href="">{{$settings['site_email']}}</a>, Attention: General Counsel with questions about these Terms of Use.</p>
        
            </div>
        </div>
    </div>
</main>























@endsection