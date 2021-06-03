import { lazy, Suspense } from 'react';

export const SocialShare = lazy(() => import(
    /* webpackMode: "lazy", webpackChunkName: "social-share" */
    '../component/SocialShare'
));

const renderItemsCount = (args, callback, instance) => {
    const [isVisibleOnMobile] = args;

    return (
        <>
            { callback.apply(instance, args) }
            { renderSocialShare(instance.props, isVisibleOnMobile) }
        </>
    );
};

const renderSocialShare = (props, isVisibleOnMobile) => {
    const {
        category: {
            description
        },
        socialShare: {
            socialShareConfig: {
                enabled, categoryPage, rounded, size
            }, providers
        }, device
    } = props;

    if (isVisibleOnMobile && !device.isMobile) {
        return null;
    }

    if (!isVisibleOnMobile && device.isMobile) {
        return null;
    }

    if (!enabled || !categoryPage) {
        return null;
    }

    return (
        <Suspense fallback={ null }>
            <SocialShare
              isRounded={ rounded }
              size={ size }
              providers={ providers }
              quote={ description }
            />
        </Suspense>
    );
};

export const config = {
    'Route/CategoryPage/Component': {
        'member-function': {
            renderItemsCount
        }
    }
};

export default config;
