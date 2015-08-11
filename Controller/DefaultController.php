<?php

namespace BBIT\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $templateToExtend = $this->container->getParameter('bbit_blog.extend_template');

        $posts = $this->get('doctrine.orm.entity_manager')->getRepository('BBITBlogBundle:Post')->findBy(array('published' => true));
        return $this->render('BBITBlogBundle::list.html.twig', array('templateToExtend' => $templateToExtend, 'posts' => $posts));
    }

    public function viewAction($slug)
    {
        $templateToExtend = $this->container->getParameter('bbit_blog.extend_template');
        $disqus_shortname = $this->container->getParameter('bbit_blog.disqus_shortname');

        $posts = $this->get('doctrine.orm.entity_manager')->getRepository('BBITBlogBundle:Post')->findOneBy(array('slug' => $slug, 'published' => true));

        return $this->render('BBITBlogBundle::view.html.twig', array(
            'templateToExtend' => $templateToExtend,
            'post' => $posts,
            'disqus_shortname' => $disqus_shortname
        ));
    }
}
