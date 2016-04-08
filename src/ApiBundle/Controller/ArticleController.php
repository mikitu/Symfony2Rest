<?php

namespace ApiBundle\Controller;

use ApiLib\Collection\ArticleCollection;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends FOSRestController
{
    /**
     * @Route("/articles")
     * @Method({"GET"})
     * @View()
     */
    public function indexAction($page = 1)
    {
        $articleRepository = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Article');
        $articlesCollection = (new ArticleCollection($articleRepository))
                                ->setPage($page)
                                ->setLimit(10);
        $articles = $articlesCollection->all();
        return $this->view($articlesCollection->all(), 200);
    }

    /**
     * @Route("/article/{article_id}", requirements={"article_id" = "\d+"})
     * @Method({"GET"})
     * @View()
     */
    public function articleAction($article_id)
    {
        $articleEntity = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Article');
        return $this->view($articleEntity->get($article_id), 200);
    }

    /**
     * @Route("/article/{article_id}/answers", requirements={"article_id" = "\d+"})
     * @Method({"GET"})
     * @View()
     */
    public function articleAnswersAction($article_id)
    {
        $articleEntity = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Article');
        return $this->view($articleEntity->getAnswers($article_id), 200);
    }

    /**
     * @Route("/article/{article_id}/answers", requirements={"article_id" = "\d+"})
     * @Method({"POST"})
     * @View()
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function createArticleAnswersAction(Request $request)
    {
        $articleEntity = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Article');
        $data = [
            'article_id' => $request->request->get('article_id'),
            'name' => $request->request->get('name'),
            'body' => $request->request->get('answer'),
            'rating' => $request->request->get('rating')
            ];
        return $this->view($articleEntity->saveAnswer($data), 200);
    }

    /**
     * @Route("/articles")
     * @Method({"POST"})
     * @View()
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function createArticleAction(Request $request)
    {
        $articleEntity = $this->getDoctrine()->getManager()->getRepository('ApiBundle:Article');
        $data = [
            'title' => $request->request->get('title'),
            'excerpt' => $request->request->get('excerpt'),
            'body' => $request->request->get('body')
            ];
        return $this->view($articleEntity->saveArticle($data), 200);
    }

}
