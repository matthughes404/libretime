<?php

class Application_Form_PodcastPreferences extends Zend_Form_SubForm {

    public function init() {
        $isPrivate = Application_Model_Preference::getStationPodcastPrivacy();
        $stationPodcastPrivacy = new Zend_Form_Element_Radio("stationPodcastPrivacy");
        $stationPodcastPrivacy->setLabel(_('Feed Privacy'));
        $stationPodcastPrivacy->setMultiOptions(array(
                                                    _("Public"),
                                                    _("Private"),
                                                ));
        $stationPodcastPrivacy->setSeparator(' ');
        $stationPodcastPrivacy->addDecorator('HtmlTag', array('tag' => 'dd',
            'id'=>"stationPodcastPrivacy-element",
            'class' => 'radio-inline-list',
        ));
        $stationPodcastPrivacy->setValue($isPrivate);
        $this->addElement($stationPodcastPrivacy);

        $stationPodcast = PodcastQuery::create()->findOneByDbId(Application_Model_Preference::getStationPodcastId());
        $url = $stationPodcast->getDbUrl();
        $feedUrl = new Zend_Form_Element_Text("stationPodcastFeedUrl");
        $feedUrl->setAttrib('class', 'input_text')
            ->setAttrib('disabled', 'disabled')
            ->setRequired(false)
            ->setLabel(_("Feed URL"))
            ->setValue($url);
        $this->addElement($feedUrl);
    }

}