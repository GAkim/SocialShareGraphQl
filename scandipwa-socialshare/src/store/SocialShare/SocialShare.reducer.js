import { UPDATE_SOCIAL_SHARE } from './SocialShare.action';

/** @namespace ScandipwaSocialshare/Store/SocialShare/Reducer/getInitialState */
export const getInitialState = () => ({
    socialShare: {
        enabled: 'not'
    }
});

/** @namespace ScandipwaSocialshare/Store/SocialShare/Reducer/SocialShareReducer */
export const SocialShareReducer = (
    state = getInitialState(),
    action
) => {
    const {
        type,
        socialShare
    } = action;

    switch (type) {
    case UPDATE_SOCIAL_SHARE:
        return {
            ...state,
            ...socialShare
        };

    default:
        return state;
    }
};

export default SocialShareReducer;
