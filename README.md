# lbaw2231 - WhatsNew


WhatsNew is a collaborative news website that enables the user to submit articles and stay connected with other publishers around the world.<br>
Unlike the equivalent websites, our product enables an easy and unified access to relevant articles from various topics, promoting an healthy space for debates and sharing information.


### 1. Installation

Link to the release with the final version of the source code in the group's Git repository.
Include the full Docker command to start the image available at the group's GitLab Container Registry using the production database.


### 2. Usage

URL to the product: http://lbaw222331.lbaw.fe.up.pt


#### 2.1. Administration Credentials

Administration URL:

| Username |Password |
| -------- | -------- |
| admin@gmail.com     | admin     |


### 3. Application Help

In the side bar, there is an option named "Help". There is an accordion type display with 
the FAQ.



### 4. Input Validation



Describe how input data was validated, and provide examples to scenarios using both client-side and server-side validation.


### 5. Check Accessibility and Usability

Accessibility: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2231/-/blob/main/acessibilidade.pdf
Usability: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2231/-/blob/main/usabilidade.pdf


### 6. HTML & CSS Validation

HTML: https://validator.w3.org/nu/
CSS: https://jigsaw.w3.org/css-validator/

Here are some example for testing HTML:
![](https://i.imgur.com/bQ8cBgP.png)

Here is the link:

https://validator.w3.org/nu/?doc=https%3A%2F%2Fgit.fe.up.pt%2Flbaw%2Flbaw2223%2Flbaw2231

Here are some examples for testing CSS:

https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fgit.fe.up.pt%2Flbaw%2Flbaw2223%2Flbaw2231&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=pt-BR

Here is the link:

![](https://i.imgur.com/EMweCMr.png)




### 7. Revisions to the Project

None were made.


### 8. Web Resources Specification

Updated OpenAPI specification in YAML format to describe the final product's web resources.


Link to the a9_openapi.yaml file in the group's repository.


openapi: 3.0.0

...



### 9. Implementation Details

#### 9.1. Libraries Used

Include reference to all the libraries and frameworks used in the product.
Include library name and reference, description of the use, and link to the example where it's used in the product.


#### 9.2 User Stories

This subsection should include all high and medium priority user stories, sorted by order of implementation. Implementation should be sequential according to the order identified below.
If there are new user stories, also include them in this table.
The owner of the user story should have the name in bold.
This table should be updated when a user story is completed and another one started.



#### Guest

| Identifier | Name                      | Priority | Description                                                                                                           |Team Members     | State | 
| ---------- | ------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------- | --- | ------------ |
| US01       | Sign-up                   | High     | As a Guest, I want to be able to register on the site, so that I can authenticate myself.                             | Inês Gaspar, Maria Gonçalves, Pedro Barbeira, **Pedro Ferreira**  |   100%           |
| US02       | Sign-in                   | High     | As a Guest, I want to be able to authenticate myself on the site, so that I have access to privileged features.       | **Inês Gaspar**, Maria Gonçalves, Pedro Barbeira, Pedro Ferreira    |   100%           |
| US03       | Sign-out                  | High     | As a Guest, I want to sign out my already logged in account, so that other people can’t impersonate me.               | Inês Gaspar, **Maria Gonçalves**, Pedro Barbeira, Pedro Ferreira    |    100%          |
| US04       | See Main Page             | High     | As a Guest, I want to access the main page, so that I can see the news/comments on the site.                          |Inês Gaspar, Maria Gonçalves, **Pedro Barbeira**, Pedro Ferreira     | 100%             |
| US05       | Search                    | High     | As a Guest, I want to search for keywords in the site, so that I can see quickly the news/comments I’m interested in. | **Pedro Barbeira**    |  100%            |
| US06       | View details              | High     | As a Publisher, I want to view article/comment details so that I can know more about them (author, date, votes, etc). | **Inês Gaspar**, Maria Gonçalves    |  100%            |
| US07       | View Categories           | Medium   | As a Guest, I want to see all the categories, so that I can explore articles from a specific group.                   | Maria Gonçalves, **Pedro Ferreira**    |    100%          |
| US08       | View Topics               | Medium   | As a Guest, I want to see the existent topics, so that I can explore the articles related to a specific topic.        |Maria Gonçalves, Pedro Barbeira, **Pedro Ferreira**     |  100%          |
| US09       | See Contacts Section      | Medium   | As a Guest, I want to access the contacts section, so that I can get in touch with the creators of the site.          |Inês Gaspar, **Maria Gonçalves**, Pedro Barbeira, Pedro Ferreira     |    100%          |
| US10       | Search with Filters       | Medium   | As a Guest, I want to apply filters to my searches, so that I can see what interests me the most more quickly.        | **Inês Gaspar**, Pedro Barbeira     |    100%          |
| US11       | See About Page            | Medium   | As a Guest, I want to access the about page, so that I can get to know the creators of the site and their purpose.    | Maria Gonçalves, **Pedro Ferreira**    |     100%         |
| US12       | Help Menu                 | Medium   | As a Guest, I want a help menu so that I can find support to my questions.                                            | Pedro Barbeira, **Pedro Ferreira**    |     100%         |
| US13       | FAQ                       | Medium   | As a Guest, I want a Frequently Asked Questions page so that I can easily find answers I might need.                  | **Pedro Barbeira**, Pedro Ferreira    |    100%          |
| US14       | Contextual Error Messages | Medium   | As a Guest, I want contextual error messages so that I’m alerted when I try to do something the wrong way.            | **Inês Gaspar**, Pedro Barbeira    |     75%         |

<p align= "center">
 <b><i>Table2- Guest's User Stories</i></b>
</p>


#### Publisher

| Identifier | Name                   | Priority | Description                                                                                                                        | Team Members    | Score    |
| ---------- | ---------------------- | -------- | ---------------------------------------------------------------------------------------------------------------------------------- | --- | --- |
| US15       | News feed              | High     | As a Publisher, I want to see my News feed populated so that I can easily stay updated.                                            |Inês Gaspar, **Pedro Barbeira**     |  100%   |
| US16       | Reputation vote        | High     | As a Publisher, I want to up/downvote articles/comments so that I can provide feedback to the authors.                             |**Inês Gaspar**, Pedro Barbeira     | 100%    |
| US17       | Leave comment          | High     | As a Publisher, I want to leave comments on articles so that I can express my opinion.                                             |Inês Gaspar, **Pedro Barbeira**     | 100%    |
| US18       | Delete account         | High     | As a Publisher, I want to delete my account so that my information gets cleared from the website.                                  |**Maria Gonçalves**, Pedro Ferreira     | 100%    |
| US19       | Notifications          | High     | As a Publisher, I want to get notified when a new article gets published so that I can quickly know about it.                      | Inês Gaspar, **Pedro Barbeira**  |  100%   |
| US20       | Manage tags            | High     | As a Publisher, I want to select/unselect news tags so that I can manage what kind of news appear on my feed.                      | Maria Gonçalves, **Pedro Ferreira**     | 100%    |
| US21       | Manage news            | High     | As a Publisher, I want to publish, remove and edit a piece of news, so that I can maintain a high level of quality on the website. |Inês Gaspar, **Pedro Barbeira**     | 100%    |
| US22       | Link tags              | High     | As a Publisher, I want to link tags and topics so that Publishers can access what might interest them the most.                    |  **Inês Gaspar**, Pedro Barbeira   |  100%   |
| US23       | View/Edit profile      | High     | As a Publisher, I want to see and/or edit my user profile, so that I can update my account info.                                   | Inês Gaspar, Maria Gonçalves, Pedro Barbeira, **Pedro Ferreira**    | 100%    |
| US24       | Upload profile picture | Medium   | As a Publisher, I want to be able to upload a profile picture so that I can customize my profile.                                  |**Maria Gonçalves**, Pedro Ferreira     | 100%    |
| US25       | View other profiles    | Medium   | As a Publisher I want to see other Publishers’ profiles so that I can see their reputation and publications.                       |**Maria Gonçalves**, Pedro Ferreira     | 100%    |
| US26       | Block Publisher        | Medium   | As a Publisher, I want to block other Publishers so that they can’t see my activity.                                               |Maria Gonçalves, **Pedro Ferreira**     |  50%   |
| US27       | Send friend request    | Medium   | As a Publisher, I want to be friend with other Publishers so that I can follow their activity throughout the page.                 |**Maria Gonçalves**, Pedro Barbeira     |  50%   |
| US32       | Topic proposal         | Low      | As a Publisher, I want to propose topics so that I can improve the quality and diversity of the website.                           |**Maria Gonçalves**, Pedro Ferreira     | 100%    |

<p align= "center">
 <b><i>Table 2 - Publisher's User Stories</i></b>
</p>

#### Administrator
| Identifier | Name                   | Priority | Description                                                                                                                                                                 | Team Members    | State    |
| ---------- | ---------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --- | --- |
| US33       | Ban user               | High     | As an Admin, I want to ban a user, so that I can remove permanently someone who is not respecting the website rules.                                                        |**Maria Gonçalves**, Pedro Ferreira     |100%     |
| US34       | Remove article/comment | High     | As an Admin, I want to remove an article or a comment so that I can delete content that is against the website policies.                                                    | **Inês Gaspar**, Maria Gonçalves, Pedro Barbeira, Pedro Ferreira    |  0%   |
| US35       | Manage topic proposal  | High     | As an Admin, I want to manage a topic proposal made by a publisher, so that I can prevent them from creating inconvenient topics or an already existent one.                |Inês Gaspar, Maria Gonçalves, **Pedro Barbeira**, Pedro Ferreira     | 100%    |
| US36       | Check veracity         | High     | As an Admin, I want to check the veracity of an article, so that I make sure there’s no fake news or misinformation on the website.                                         |Inês Gaspar, Maria Gonçalves, Pedro Barbeira, **Pedro Ferreira**     |  0%   |



<p align= "center">
 <b><i>Table 4- Administrator's User Stories</i></b>
</p>





## A10: Presentation

This artifact corresponds to the presentation of the product.


### 1. Product presentation

WhatsNew is a news website which allows user all over the world send and share credible and relevant information.
This is the ideal space for any publisher who wants to posts his / her articles, create a new topics and link categories to make the articles more relevant and also comment the news of another publisher.
URL to the product: http://lbaw2231.lbaw.fe.up.pt
Slides used during the presentation should be added, as a PDF file, to the group's repository and linked to here.


### 2. Video presentation

![](https://i.imgur.com/kkW5MFy.png)

https://youtu.be/twPbxkfwwgk


Revision history

* 28/11/2022 - 2/1/2022 -> added and developed the features of high and medium priority.


GROUP2231, 03/01/2023

* Group member 1: [Inês Sá Pereira Estêvão Gaspar](https://github.com/ines-08), up202007210@edu.fe.up.pt (Editor)
* Group member 2: [Maria Sofia Brandão Porto Carvalho Gonçalves](https://github.com/MSofiaGoncalves), up202006927@edu.fe.up.pt (Editor)
* Group member 3: [Pedro Fardilha Barbeira](https://github.com/pedrobarbeira), up201303693@edu.fe.up.pt (Editor)
* Group member 4: [Pedro Pereira Ferreira](https://github.com/Pedro-PFerreira/), up202004986@edu.fe.up.pt (Editor)
