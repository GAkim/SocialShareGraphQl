import { Field } from 'Util/Query';

/** @namespace ScandipwaSocialshare/Query/SocialShare/Query/SocialShareQuery */
export class SocialShareQuery {
    getQuery() {
        return new Field('socialShare')
            .addFieldList(['enabled']);
    }
}

export default new SocialShareQuery();
