<?php

namespace ElsassSeeraiwer\ESBarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Kevin Eyermann <kevin.eyermann@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elsass_seeraiwer_es_bar');

        $rootNode
            ->children()
                ->booleanNode('toolbar')->defaultTrue()->end()
                ->variableNode('classname')->defaultValue('toto')->end()
                ->booleanNode('locale_tool')->defaultTrue()->end()
                ->booleanNode('registration')->defaultTrue()->end()
                ->variableNode('style')->defaultValue('google')->end()
                ->scalarNode('position')
                    ->defaultValue('top')
                    ->validate()
                        ->ifNotInArray(array('bottom', 'top'))
                        ->thenInvalid('The CSS position %s is not supported')
                    ->end()
                ->end()
                ->arrayNode('templates')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('controller')->end()
                            ->scalarNode('template')->end()
                            ->booleanNode('next')->defaultTrue()->end()
                            ->variableNode('parameters')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('icons')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->variableNode('login')->defaultValue('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAcCAYAAAB75n/uAAAC70lEQVR42u2V3UtTYRzHu+mFwCwK+gO6CEryPlg7yiYx50vDqUwjFIZDSYUk2ZTmCysHvg9ZVggOQZiRScsR4VwXTjEwdKZWk8o6gd5UOt0mbev7g/PAkLONIOkiBx+25/v89vuc85zn2Q5Fo9F95UDwnwhS5HK5TyqVRv8m1JN6k+AiC+fn54cwbgFNIrTQ/J9IqDcJJDGBHsgDgYBSq9W6ysvLPf39/SSUUU7zsQ1yc3MjmN90OBzfRkZG1umzQqGIxPSTkIBjgdDkaGNjoza2kcFgUCE/QvMsq6io2PV6vQu1tbV8Xl7etkql2qqvr/+MbDE/Pz8s9OP2Cjhwwmw29+4R3Kec1WZnZ4fn5uamc3Jyttra2qbH8ero6JgdHh5+CvFHq9X6JZHgzODgoCVW0NPTY0N+ltU2Nzdv4GqXsYSrPp+vDw80aLFYxru6uhyQ/rDb7a8TCVJDodB1jUazTVlxcXGQ5/mbyE+z2u7u7veY38BVT3Z2djopm5qa6isrK/tQWVn5qb29fSGR4DC4PDAwMEsZHuArjGnyGKutq6v7ajQaF6urq9/MzMz0QuSemJiwQDwGkR0POhhXgILjNTU1TaWlpTxlOp1uyWQyaUjMajMzM8Nut/tJQUHBOpZppbCwkM/KytrBznuL9xDVxBMo8KXHYnu6qKjIivmrbIy67x6Px4Yd58W672ApfzY0NCyNjo7OZmRkiAv8fr+O47iwmABXtoXaG3uykF6vX7bZbF6cgZWqqiqezYkKcNtmjO+CF2AyhufgjsvlMiU7vXEF+4C4ALf9CwdrlVAqlcFkTdRqdQSHLUDgBEeSCrArAsiGwENs0XfJBE6ncxm1D8Aj/B6tigkkJSUlmxSwLYhMDeRsyyUCd+lHrWxtbe2aTCbbZTn1ZD92F0Cr8GBfgnsgDZwDt8EzMBmHMXBLqD0PDMAh9Gql3iRIESQSIAXp4CRIBZeEjIvDFZAm1J4C6UK9ROiZcvCn/+8FvwHtDdJEaRY+oQAAAABJRU5ErkJggg==')->end()
                        ->variableNode('login_google')->defaultValue('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAcCAYAAAB75n/uAAADg0lEQVR42u1WXUhTYRjej+5sutHZpmTq5tRYGaRmJmYUzIsJKkooShTdCHqhiAbmhRf5A0I3XoggeuFFOJL0oiRBRZAMja05f2BliIn/OtvQtpS5tvV8dg6Mqasg8cYPHs77vec7z7Pved9zvnG9Xi/nNAePc8rjXODsBbiAZHh4eEogEMRz/uM4ODhY0Gq1N4IQK1nyyspK3ezs7FeEnuN2m5iYGNfa2vrwbwQYTiURkLFJkJtxMQqFQgpET/h8vlCv1490dnaOkd3i/r4vye7urndgYMCxtrbmEIlEfJlMJsrPzxeHhoZymSUyIsD3ecYIjNXV1T1Wq9UakoiPj78dExNTgNxbX/K5uTlXW1vbXElJiTw7O5t2u92e+fl5W21t7XJTU1OCVCrlEW7/IrsAym63X/fLawEhc5/jcDg8HR0dk83NzbGbm5vLiN+Nj49/np6enqqoqAgdGhpaD9RFAjzE9U1sbW2F4CJi5waDwVpcXExvb29b+vr6TNXV1Zko6reIiIigyMhIqdVq3Qwk4Orp6THA1z0y2djYcILkI8KfPt7vKBQKudlsXs7Ly4tDQSmTybSIJriysrKyo1QqqUACe6TFRkZGzGTS3d2tX19fn0X4g10QHR0dAr8tqA09MTEx39/f/w6N4ZmZmfmk0+kMmZmZanZtkD97RkZGcFFRkVYul0eReW5ubnhSUlIU/Haza1JSUi41NjYa4Ped0tJSrVgslmRlZaUtLS0touCXKYoSnLSDEPj5Ijk5+RksiCSJBAy8MDrY1soUmoP25YFc09LSMoTdudCiUpvN5rJYLNz29vYZj8dz/KcC/asMCwu7f9yLg7Z7hMtFdh4eHk7X19cXQyyot7d3YXR0dIOm6QtVVVW3eLxD2qMWpaamxmo0mucIb5Ju8q0LoMc9te96YgUsvQr4/57jBRoaGp4GePuzOf8+jhbZ6XS6jUbjEonRdlESiYQKRADfvZOTk04Sp6enU7CSG1BgdXXVhc/CB4T7OTk592pqatSBBLq6ur4MDg6+J/UsLCzUoPhx/ueBG6R2NqFSqYj3b4BX+Lqq/mRBeXm5gqxF1w2UlZUp2DzD6SbbuQY8ANIYQSOgIzsACoC7gPgE/u/AGPCauMGsJxUPBgzAy8MDByDKckZgByA18AIxpEN/H0xHB3Nu2IAV5lklQDN5K8mf/y86e4FfVOZOykx2nIkAAAAASUVORK5CYII=')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
